<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class InstallationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('instal');
    }

    public function index()
    {
        return view('welcome', [
            'extensions' => $this->extensions(),
            'directories' => $this->directories(),
            'satisfied' => $this->satisfied(),
        ]);
    }

    public function configuration()
    {
        return view('configuration');
    }

    public function postconfiguration(Request $request)
    {
        $data = $request->validate([
            "db.host" => "required",
            "db.port" => "required",
            "db.database" => "required",
            "db.username" => "required",
            "db.password" => "",
            "app.*" => "required",
        ]);
        $this->fileStore($request->app['logo']);
        $this->envEdit($data);
        return redirect(route('configadmin'));
    }


    public function configadmin()
    {
        return view('configadmin');
    }

    public function postconfigadmin(Request $request)
    {
        $data = $request->validate([
            "admin.*"  => "required",
        ]);
        $this->migrate($data['admin']);
        return redirect('/');
    }
    public function extensions()
    {
        return [
            'PHP >= 7.2' => version_compare(phpversion(), '7.2'),
            'FileInfo PHP Extension' => extension_loaded('fileinfo'),
            'BCMath PHP Extension' => extension_loaded('bcmath'),
            'Curl PHP Extension' => extension_loaded('curl'),
            'OpenSSL PHP Extension' => extension_loaded('openssl'),
            'PDO PHP Extension' => extension_loaded('pdo'),
            'Mbstring PHP Extension' => extension_loaded('mbstring'),
            'Tokenizer PHP Extension' => extension_loaded('tokenizer'),
            'XML PHP Extension' => extension_loaded('xml'),
            'Ctype PHP Extension' => extension_loaded('ctype'),
            'JSON PHP Extension' => extension_loaded('json'),
        ];
    }

    public function directories()
    {
        return [
            '.env' => is_writable(base_path('.env')),
            'storage' => is_writable(storage_path()),
            'bootstrap/cache' => is_writable(app()->bootstrapPath('cache')),
        ];
    }

    /**
     * @return mixed
     */
    public function satisfied()
    {
        return collect($this->extensions())
            ->merge($this->directories())
            ->every(function ($item) {
                return $item;
            });
    }

    public function envEdit($data)
    {
        try {
            $env = DotenvEditor::load();
            $env->setKey('APP_NAME', $data['app']['name']);
            $env->setKey('APP_ENV', $data['app']['env']);
            $env->setKey('APP_DEBUG', $data['app']['debug']);
            $env->setKey('APP_URL', $data['app']['url']);
            $env->setKey('DB_HOST', $data['db']['host']);
            $env->setKey('DB_PORT', $data['db']['port']);
            $env->setKey('DB_DATABASE', $data['db']['database']);
            $env->setKey('DB_USERNAME', $data['db']['username']);
            $env->setKey('DB_PASSWORD', $data['db']['password']);
            $env->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function migrate($data)
    {
        $env = DotenvEditor::load();
        $env->setKey('APP_INSTALLED', 'true');
        $env->save();
        Artisan::call('migrate:fresh', ['--force' => true]);
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => 0,
            'password' => Hash::make($data['password']),
        ]);
    }

    public function fileStore($data)
    {
        $imageName = 'logo.png';
        $data->move(public_path('image/logo'), $imageName);
    }
}
