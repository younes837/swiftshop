<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Brand;
use App\Models\Categorie;
use App\Models\UserProduit;
use DB;
use Auth;
class StaterkitController extends Controller
{
    // home
    public function home()
    {
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['name' => 'Index'],
        ];
        $pageConfigs = [
            'contentLayout' => 'content-detached-left-sidebar',
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
            'mainLayoutType' => 'horizontal',
        ];
        return view('/content/home', [
            'breadcrumbs' => $breadcrumbs,
            'pageConfigs' => $pageConfigs,
        ]);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            if (Auth::check()) {
                $user = Auth::user();
                $wishlist = $user->produits;
            }
            $query = $request->get('query');
            $price = $request->get('price');
            $sort = $request->get('sort');
            $brand = $request->get('brand');
            $brandChamp='brand_id';
            if ($sort == 'asc') {
                $sortedby = 'price';
            } elseif ($sort == 'desc') {
                $sortedby = 'price';
            } else {
                $sortedby = 'id';
                $sort = 'asc';
            }
            $categorie = $request->get('categorie');
            if ($categorie == 'all') {
                $categorie = null;
                $cat = null;
            } else {
                $cat = 'categorie_id';
            }
            if ($brand=="all") {
                $brand=null;
                $brandChamp=null;
            }
            if ($query != '') {
                if ($price == 'all') {
                    $produits = DB::table('produit')
                        ->where($cat, $categorie)
                        ->where(function ($q) use ($query,$brand,$brandChamp) {
                            $q
                                ->where('libelle', 'like', '%' . $query . '%')
                                ->where($brandChamp,$brand)
                                ;
                        })
                        ->orderBy($sortedby, $sort)
                        ->paginate(9);
                } elseif ($price == '100') {
                    $produits = DB::table('produit')
                        ->where(function ($q) use ($query, $cat, $categorie) {
                            $q

                                ->where('price', '<=', 100)
                                ->where($cat, $categorie);
                        })
                        ->where(function ($q) use ($query,$brand,$brandChamp) {
                            $q
                                ->where('libelle', 'like', '%' . $query . '%')
                                ->Where($brandChamp,$brand)
                                ;
                        })
                        ->orderBy($sortedby, $sort)
                        ->paginate(9);
                } elseif ($price == '100-1000') {
                    $produits = DB::table('produit')
                        ->where(function ($q) use ($cat, $categorie) {
                            $q
                                ->where($cat, $categorie)
                                ->where('price', '<=', 1000)
                                ->where('price', '>=', 100);
                        })
                        ->where(function ($q) use ($query,$brand,$brandChamp) {
                            $q
                                ->where('libelle', 'like', '%' . $query . '%')
                                ->Where($brandChamp,$brand)
                                ;
                        })
                        ->orderBy($sortedby, $sort)
                        ->paginate(9);
                } elseif ($price == '1000-5000') {
                    $produits = DB::table('produit')
                        ->where(function ($q) use ($cat, $categorie) {
                            $q
                                ->where($cat, $categorie)
                                ->where('price', '<=', 5000)
                                ->where('price', '>=', 1000);
                        })
                        ->where(function ($q) use ($query,$brand,$brandChamp) {
                            $q
                                ->where('libelle', 'like', '%' . $query . '%')
                                ->Where($brandChamp,$brand)
                                ;
                        })

                        ->orderBy($sortedby, $sort)
                        ->paginate(9);
                } elseif ($price == '5000') {
                    $produits = DB::table('produit')
                        ->where(function ($q) use ($query, $cat, $categorie) {
                            $q
                                ->where('price', '>=', 5000)
                                ->where($cat, $categorie);
                        })

                        ->where(function ($q) use ($query,$brand,$brandChamp) {
                            $q
                                ->where('libelle', 'like', '%' . $query . '%')
                                ->Where($brandChamp,$brand)
                                ;
                        })
                        ->orderBy($sortedby, $sort)
                        ->paginate(9);
                }
                $total_row = $produits->total();
            } else {
                $produits = DB::table('produit')->paginate(9);

                if ($price == 'all') {
                    $produits = DB::table('produit')
                        ->where($cat, $categorie)
                        ->where($brandChamp, $brand)
                        ->orderBy($sortedby, $sort)
                        ->paginate(9);
                } elseif ($price == '100') {
                    $produits = DB::table('produit')
                        ->where('price', '<=', 100)
                        ->where($cat, $categorie)
                        ->where($brandChamp, $brand)
                        ->orderBy($sortedby, $sort)
                        ->paginate(9);
                } elseif ($price == '100-1000') {
                    $produits = DB::table('produit')
                        ->where('price', '<=', 1000)
                        ->where('price', '>=', 100)
                        ->where($brandChamp, $brand)
                        ->where($cat, $categorie)
                        ->orderBy($sortedby, $sort)
                        ->paginate(9);
                } elseif ($price == '1000-5000') {
                    $produits = DB::table('produit')
                        ->where('price', '<=', 5000)
                        ->where('price', '>=', 1000)
                        ->where($brandChamp, $brand)
                        ->where($cat, $categorie)
                        ->orderBy($sortedby, $sort)
                        ->paginate(9);
                } elseif ($price == '5000') {
                    $produits = DB::table('produit')
                        ->where('price', '>=', 5000)
                        ->where($cat, $categorie)
                        ->where($brandChamp, $brand)
                        ->orderBy($sortedby, $sort)
                        ->paginate(9);
                }
                $total_row = $produits->total();
            }
            if (Auth::check()) {
                # code...
                return view(
                    'content.ecommerce.content-shop',
                    compact('produits', 'wishlist')
                )->render();
            }
            return view(
                'content.ecommerce.content-shop',
                compact('produits')
            )->render();
        }
    }

    public function ecommerce_shop()
    {
        $pageConfigs = [
            'contentLayout' => 'content-detached-left-sidebar',
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
            'mainLayoutType' => 'horizontal',
        ];

        // $breadcrumbs = [
        //     ['link' => '/', 'name' => 'Home'],
        //     ['link' => 'javascript:void(0)', 'name' => 'eCommerce'],
        //     ['name' => 'Shop'],
        // ];
        $produits = Produit::paginate(9);
        $categories = Categorie::all();
        $brand = Brand::all();
        $p = Produit::all();
        $length = count($p);
        if (Auth::check()) {
            # code...
            $user = Auth::user();
            $wishlist = $user->produits;
            return view('/content/ecommerce/app-ecommerce-shop', [
                'pageConfigs' => $pageConfigs,
                'wishlist' => $wishlist,
                'brand' => $brand,
                'produits' => $produits,
                'categories' => $categories,
                'length' => $length,
            ]);
        } else {
            return view('/content/ecommerce/app-ecommerce-shop', [
                'pageConfigs' => $pageConfigs,

                'brand' => $brand,
                'produits' => $produits,
                'categories' => $categories,
                'length' => $length,
            ]);
        }
    }
    public function whishlist(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            if ($request->details == 'non') {
                if ($request->on == 'false') {
                    UserProduit::create([
                        'user_id' => $user->id,
                        'produit_id' => $request->id,
                    ]);
                } elseif ($request->on == 'true') {
                    UserProduit::where('user_id', $user->id)
                        ->where('produit_id', $request->id)
                        ->delete();
                }
                // $produit = Produit::find($request->id);
                // $produit->favorie = !$produit->favorie;
                // $produit->save();

                $wishlist = $user->produits;

                $produits = Produit::paginate(9);
                return view(
                    'content.ecommerce.content-shop',
                    compact('produits', 'wishlist')
                )->render();
            } elseif ($request->details == 'oui') {
                $produit = Produit::find($request->id);
                if ($request->on == 'false') {
                    UserProduit::create([
                        'user_id' => $user->id,
                        'produit_id' => $request->id,
                    ]);
                } elseif ($request->on == 'true') {
                    UserProduit::where('user_id', $user->id)
                        ->where('produit_id', $request->id)
                        ->delete();
                }
                $wishlist = $user->produits;
                return view(
                    'content/ecommerce/produit-details',
                    compact('produit', 'wishlist')
                )->render();
            }elseif ($request->details == 'remove') {
                UserProduit::where('user_id', $user->id)
                ->where('produit_id', $request->id)
                ->delete();
                $produits = DB::table('user_produit')
                ->join('users', 'user_produit.user_id', 'users.id')
                ->join('produit', 'user_produit.produit_id', 'produit.id')
                ->select(
                    'produit.id',
                    'produit.libelle',
                    'produit.photo',
                    'produit.description',
               
                    'produit.stock',
                    'produit.rating',
                    'produit.price'
                    )
                    ->where('users.id',$user->id)
                    ->paginate(12);
                return view(
                    'content/ecommerce/wishlist-content',
                    compact('produits')
                )->render();
            }
        }
    }
    public function wishlist_details(Request $request)
    {
        if ($request->ajax()) {
            $users=Auth::user();
            $produits = DB::table('user_produit')
            ->join('users', 'user_produit.user_id', 'users.id')
            ->join('produit', 'user_produit.produit_id', 'produit.id')
            ->select(
                'produit.id',
                'produit.libelle',
                'produit.photo',
                'produit.description',
               
                'produit.stock',
                'produit.rating',
                'produit.price'
                )
                ->where('users.id',$users->id)
                ->paginate(12);
            return view(
                'content/ecommerce/wishlist-content',
                compact('produits')
            )->render();
        }
    }

    // Ecommerce Details
    public function ecommerce_details($id)
    {
        // return $id;
        $pageConfigs = [
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
            'mainLayoutType' => 'horizontal',
        ];
        $produit = Produit::find($id);
        $brand = Brand::find($produit->brand_id);
        $breadcrumbs = [
            ['link' => '/', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'eCommerce'],
            ['link' => '/app/ecommerce/shop', 'name' => 'Shop'],
            ['name' => 'Details'],
        ];
        $user = Auth::user();
        if (Auth::check()) {
            # code...
            $wishlist = $user->produits;
            return view('/content/ecommerce/app-ecommerce-details', [
                'pageConfigs' => $pageConfigs,
                // 'breadcrumbs' => $breadcrumbs,
                'wishlist' => $wishlist,
                'produit' => $produit,
                'brand' => $brand,
            ]);
        }else {
            return view('/content/ecommerce/app-ecommerce-details', [
                'pageConfigs' => $pageConfigs,
                // 'breadcrumbs' => $breadcrumbs,
                'brand' => $brand,
                'produit' => $produit,
            ]);
        }

    }



    // Ecommerce Wish List
    public function ecommerce_wishlist()
    {
        $pageConfigs = [
            'showMenu' => true,
            'pageClass' => 'ecommerce-application',
            'mainLayoutType' => 'horizontal',
        ];
        if (Auth::check()) {
            
            $user = Auth::user();
            
        $produits = DB::table('user_produit')
        ->join('users', 'user_produit.user_id', 'users.id')
            ->join('produit', 'user_produit.produit_id', 'produit.id')
            ->select(
                'produit.id',
                'produit.libelle',
                'produit.photo',
                'produit.description',
                
                'produit.stock',
                'produit.rating',
                'produit.price'
                ) ->where('users.id',$user->id)
                ->paginate(12);
                return view('/content/ecommerce/app-ecommerce-wishlist', [
            'pageConfigs' => $pageConfigs,
            'produits' => $produits,
            // 'breadcrumbs' => $breadcrumbs,
        ]);
    }else {
        return view('/content/ecommerce/app-ecommerce-wishlist', [
            'pageConfigs' => $pageConfigs,
            'produits' => [],
            // 'breadcrumbs' => $breadcrumbs,
        ]);
        
        }
    }

    // Ecommerce Checkout
    public function ecommerce_checkout()
    {
        $pageConfigs = [
            'pageClass' => 'ecommerce-application',
        ];

        $breadcrumbs = [
            ['link' => '/', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'eCommerce'],
            ['name' => 'Checkout'],
        ];

        return view('/content/ecommerce/app-ecommerce-checkout', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    // Layout collapsed menu
    public function collapsed_menu()
    {
        $pageConfigs = ['sidebarCollapsed' => true];
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'Layouts'],
            ['name' => 'Collapsed menu'],
        ];
        return view('/content/layout-collapsed-menu', [
            'breadcrumbs' => $breadcrumbs,
            'pageConfigs' => $pageConfigs,
        ]);
    }

    // layout boxed
    public function layout_full()
    {
        $pageConfigs = ['layoutWidth' => 'full'];

        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['name' => 'Layouts'],
            ['name' => 'Layout Full'],
        ];
        return view('/content/layout-full', [
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }

    // without menu
    public function without_menu()
    {
        $pageConfigs = ['showMenu' => false];
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'Layouts'],
            ['name' => 'Layout without menu'],
        ];
        return view('/content/layout-without-menu', [
            'breadcrumbs' => $breadcrumbs,
            'pageConfigs' => $pageConfigs,
        ]);
    }

    // Empty Layout
    public function layout_empty()
    {
        $breadcrumbs = [
            ['link' => 'home', 'name' => 'Home'],
            ['link' => 'javascript:void(0)', 'name' => 'Layouts'],
            ['name' => 'Layout Empty'],
        ];
        return view('/content/layout-empty', ['breadcrumbs' => $breadcrumbs]);
    }
    // Blank Layout
    public function layout_blank()
    {
        $pageConfigs = ['blankPage' => true];
        return view('/content/layout-blank', ['pageConfigs' => $pageConfigs]);
    }
}
