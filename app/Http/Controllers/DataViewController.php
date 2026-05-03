<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Diagnosa;
use App\Models\Medicine;
use App\Models\Pasien;
use App\Models\Penyakit;
use App\Models\Post;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class DataViewController extends Controller
{
    /**
     * Display the data viewer page.
     */
    public function index(): View
    {
        return view('data.index');
    }

    /**
     * Get posts data.
     */
    public function posts(Request $request)
    {
        if ($request->ajax()) {
            $posts = Post::with('comments')->select('posts.*');
            
            return DataTables::of($posts)
                ->addColumn('comments_count', function ($post) {
                    return $post->comments->count();
                })
                ->editColumn('body', function ($post) {
                    return \Str::limit($post->body, 80);
                })
                ->editColumn('status', function ($post) {
                    return ucfirst($post->status);
                })
                ->editColumn('created_at', function ($post) {
                    return $post->created_at->format('d M Y');
                })
                ->make(true);
        }
        
        return view('data.index', ['table' => 'posts']);
    }

    /**
     * Get comments data.
     */
    public function comments(Request $request)
    {
        if ($request->ajax()) {
            $comments = Comment::with('post')->select('comments.*');
            
            return DataTables::of($comments)
                ->addColumn('post_title', function ($comment) {
                    return $comment->post ? \Str::limit($comment->post->title, 30) : '-';
                })
                ->editColumn('body', function ($comment) {
                    return \Str::limit($comment->body, 100);
                })
                ->editColumn('created_at', function ($comment) {
                    return $comment->created_at->format('d M Y');
                })
                ->make(true);
        }
        
        return view('data.index', ['table' => 'comments']);
    }

    /**
     * Get users data.
     */
    public function users(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select('users.*');
            
            return DataTables::of($users)
                ->editColumn('role', function ($user) {
                    return ucfirst($user->role);
                })
                ->editColumn('is_active', function ($user) {
                    return $user->is_active ? 'Active' : 'Inactive';
                })
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->format('d M Y');
                })
                ->make(true);
        }
        
        return view('data.index', ['table' => 'users']);
    }

    /**
     * Get pasien data.
     */
    public function pasien(Request $request)
    {
        if ($request->ajax()) {
            $pasien = Pasien::select('pasien.*');
            
            return DataTables::of($pasien)
                ->editColumn('tanggal_lahir', function ($p) {
                    return \Carbon\Carbon::parse($p->tanggal_lahir)->format('d M Y');
                })
                ->editColumn('jenis_kelamin', function ($p) {
                    return $p->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
                })
                ->editColumn('alamat', function ($p) {
                    return \Str::limit($p->alamat, 50);
                })
                ->editColumn('created_at', function ($p) {
                    return $p->created_at->format('d M Y');
                })
                ->make(true);
        }
        
        return view('data.index', ['table' => 'pasien']);
    }

    /**
     * Get penyakit data.
     */
    public function penyakit(Request $request)
    {
        if ($request->ajax()) {
            $penyakit = Penyakit::select('penyakit.*');
            
            return DataTables::of($penyakit)
                ->editColumn('deskripsi', function ($p) {
                    return \Str::limit($p->deskripsi, 100);
                })
                ->editColumn('created_at', function ($p) {
                    return $p->created_at->format('d M Y');
                })
                ->make(true);
        }
        
        return view('data.index', ['table' => 'penyakit']);
    }

    /**
     * Get diagnosa data.
     */
    public function diagnosa(Request $request)
    {
        if ($request->ajax()) {
            $diagnosa = Diagnosa::with(['pasien', 'penyakit'])->select('diagnosa.*');
            
            return DataTables::of($diagnosa)
                ->addColumn('pasien_nama', function ($d) {
                    return $d->pasien->nama;
                })
                ->addColumn('pasien_info', function ($d) {
                    $jk = $d->pasien->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan';
                    $umur = \Carbon\Carbon::parse($d->pasien->tanggal_lahir)->age;
                    return "$jk, $umur tahun";
                })
                ->addColumn('penyakit_nama', function ($d) {
                    return $d->penyakit->nama;
                })
                ->addColumn('penyakit_deskripsi', function ($d) {
                    return \Str::limit($d->penyakit->deskripsi, 50);
                })
                ->addColumn('kode_icd', function ($d) {
                    return $d->penyakit->kode_icd;
                })
                ->addColumn('kategori', function ($d) {
                    return $d->penyakit->kategori;
                })
                ->editColumn('catatan', function ($d) {
                    return $d->catatan ?: '-';
                })
                ->editColumn('created_at', function ($d) {
                    return $d->created_at->format('d M Y H:i');
                })
                ->make(true);
        }
        
        return view('data.index', ['table' => 'diagnosa']);
    }

    /**
     * Get vehicles data.
     */
    public function vehicles(Request $request)
    {
        if ($request->ajax()) {
            $vehicles = Vehicle::select('vehicles.*');
            
            return DataTables::of($vehicles)
                ->editColumn('created_at', function ($v) {
                    return $v->created_at->format('d M Y');
                })
                ->make(true);
        }
        
        return view('data.index', ['table' => 'vehicles']);
    }

    /**
     * Get medicines data.
     */
    public function medicines(Request $request)
    {
        if ($request->ajax()) {
            $medicines = Medicine::select('medicines.*');
            
            return DataTables::of($medicines)
                ->editColumn('created_at', function ($m) {
                    return $m->created_at->format('d M Y');
                })
                ->make(true);
        }
        
        return view('data.index', ['table' => 'medicines']);
    }
}
