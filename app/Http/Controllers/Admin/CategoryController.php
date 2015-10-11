<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use Cache;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Type;
use App\Models\Attribute;
class CategoryController extends Controller
{
    public function __construct()
    {
        view()->share(['_good' => 'am-in', '_category' => 'am-active']);
    }

    //获得无限分类
    private function get_categories()
    {
        //无限分类存入memcache
        $categories = Cache::rememberForever('admin_category_categories_wfh', function () {
            $categories = Category::orderBy('parent_id', 'asc')->orderBy('sort_order', 'asc')->orderBy( 'id', 'asc')->get();
            return tree($categories);
        });
        return $categories;
    }

    public function index()
    {
        //memcache laravel原始写法
        /*if (!Cache::has('admin_category_categories_wfh')) {
            $categories = $this->get_categories();
              Cache::forever('admin_category_categories_wfh', $categories);
         } else {
              $categories = Cache::get('admin_category_categories_wfh');
         }
        $categories = Category::orderBy('parent_id', 'asc', 'sort_order', 'asc', 'id', 'asc')->get();
        $categories= tree($categories);*/
        $categories = $this->get_categories();
        return view('admin.category.index',['categories'=>$categories]);
    }

    public function create()
    {
        $types = Type::with("attributes")->get();
        $categories = $this->get_categories();
         return view('admin.category.create ',['categories'=>$categories,'types'=>$types]);
    }

    public function store(Request $request)
    {
        Cache::forget('admin_category_categories_wfh');        //清除微信缓存
        Cache::forget('wechat_index_categories_wfh');        //清除缓存
        //检测为空
        $messages=[
            'name.required'=>'商品名不能为空',
            'filter_attr.required'=>'筛选属性不能为空'
        ];
        $this->validate($request, [
            'name' => 'required',
            'filter_attr'=>'required'
        ],$messages);
        $filter_attr = serialize(array_unique($request->filter_attr));     //数组去重复, 序列化
        $category = array_add($request->except('filter_attr'), 'filter_attr', $filter_attr);
        Category::create($category);
        return redirect(route('admin.category.index'))->with('info', '添加分类成功');
    }

    public function edit($id)
    {
        $category=Category::find($id);
        $types = Type::with("attributes")->get();
        $categories = $this->get_categories();
        $category->filter_attr = Attribute::with('type.attributes')->whereIn('id', unserialize($category->filter_attr))->get();
        return view('admin.category.edit',['category'=>$category,'categories'=>$categories,'types'=>$types]);
    }

    public function update(Request $request, $id)
    {
        Cache::forget('admin_category_categories_wfh');
        $category = Category::find($id);
        $filter_attr = serialize(array_unique($request->filter_attr));     //数组去重复, 序列化
        $data = array_add($request->except('filter_attr'), 'filter_attr', $filter_attr);
        $category->update($data);
        return redirect(route('admin.category.index'));
    }

    //删除
    public function destroy($id)
    {
        Cache::forget('admin_category_categories_wfh');
        Cache::forget('wechat_index_categories_wfh');
      Category::destroy($id);
        return back();
    }
}
