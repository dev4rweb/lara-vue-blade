<h1>Creating react-laravel project</h1>
<a href="https://deshell.art/Portfolio/Web/coinzoomer/index.html">design</a>
<a href="https://github.com/Landish/pingcrm-react">https://github.com/Landish/pingcrm-react</a>
<ol>
<li>composer create-project laravel/laravel project-name</li>
<li> <a href="https://github.com/new" > create repository on github</a></li>
<li> git-init</li>
<li> git add .</li>
<li> git commit -m "Init"</li>
<li> git remote add origin https://github.com/dev4rweb/project-name.git</li>
<li> git push -u origin master</li>
<li> <a href="https://github.com/laravel/ui">https://github.com/laravel/ui</a></li>
<li> composer require laravel/ui</li>
<li> php artisan ui react --auth</li>
<li> php artisan serve</li>
<li> npm run install && npm run dev</li>
<li> database>seeders>DatabaseSeader.php - create user</li>
<li> 
<pre>
<code>
public function run()
    {
        // \App\Models\User::factory(10)->create();

User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => \bcrypt('secret')
        ]);
}
</code>
</pre>
</li>
<li> php artisan migrate --seed</li>
<li> npm run production</li>
<li> git add .</li>
<li> git commit -m "Adding laravel UI"</li>
<li> git push</li>
<li> <a href="https://inertiajs.com/">https://inertiajs.com/</a></li>
<li> composer require inertiajs/inertia-laravel</li>
<li>resources/views/app.blade.php - create in paste html from site</li>
<li>
<pre>

```HTML
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer></script>
  </head>
  <body>
    @inertia
  </body>
```
</pre>
</li>
<li>php artisan inertia:middleware</li>
<li>app/Http/Kernel.php open and paste</li>
<li>
<pre>
<code>
'web' => [
    // ...
    \App\Http\Middleware\HandleInertiaRequests::class,
],
</code>
</pre>
</li>
<li>npm install @inertiajs/inertia @inertiajs/inertia-react</li>
<li>npm i react react-dom</li>

<li>npm install @inertiajs/progress</li>
<li>
resources/js/app.js edit
</li>
<li>
<code>
<pre>
require('./bootstrap');
import React from 'react';
import { render } from 'react-dom';
import { InertiaApp } from '@inertiajs/inertia-react';
import { InertiaProgress } from '@inertiajs/progress';

InertiaProgress.init({
color: '#ED8936',
showSpinner: true
});

const app = document.getElementById('app');

render(
<InertiaApp
initialPage={JSON.parse(app.dataset.page)}
resolveComponent={name => require(`./Pages/${name}`).default}
/>,
app
);
</pre>
</code>
</li>
<li>create resources/js/Pages/HomePage.js </li>
<li>edit .editorconfig</li>
<li>create .prettierrc</li>
<li>
<code>
<pre>
{
    "semi": false,
    "tabWidth": 2
}
</pre>
</code>
</li>
<li>create and edit .babelrc</li>
<li>
<code>
<pre>
{
    "presets": ["@babel/preset-react"]
}
</pre>
</code>
</li>
<li>npm i --save-dev @babel/preset-react</li>
<li>php artisan make:controller HomePageController</li>
<li>php artisan make:controller Api/HomePageController --api</li>
<li>
<code>
<pre>
    /**
     * Show the application dashboard.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        <mark>return Inertia::render('HomePage');</mark>
    }
</pre></code>
</li>
<li>edit routes/web.php</li>
<li><code><pre>
Route::get('/', [HomePageController::class, 'index'])->name('home-page');</pre></code></li>
<li><a href="https://github.com/barryvdh/laravel-debugbar">https://github.com/barryvdh/laravel-debugbar</a></li>
<li>composer require barryvdh/laravel-debugbar --dev</li>
<li>Edit app/Http/Controllers/Auth/LoginController.php</li>
<li>edit app/Providers/RouteServiceProvider.php</li>
<li>npm i redux react-redux redux-thunk redux-devtools-extension</li>
<li>create /resources/js/utils/reducerConsts.js</li>
<li><code><pre>

export const SET_CURRENT_USER = 'SET_CURRENT_USER'

</pre></code></li>
<li>create /resources/js/reducers/currentUserReducer.js</li>
<li><code><pre>

import {SET_CURRENT_USER} from "../utils/reducerConsts";

const defaultState = {
user: null
}

export default function currentUserReducer (state = defaultState, action) {
switch (action.type) {
case SET_CURRENT_USER:
return {
...state,
user: action.payload
}
default:
return state
}
}

export const setCurrentUser = user => ({type: SET_CURRENT_USER, payload: user})

</pre></code></li>
<li>/resources/js/reducers/index.js</li>
<li>
<code>
<pre>

import {applyMiddleware, combineReducers, createStore} from "redux";
import currentUserReducer from "./currentUserReducer";
import {composeWithDevTools} from "redux-devtools-extension";
import thunk from "redux-thunk";


const rootReducer = combineReducers({
currentUser: currentUserReducer,
})

export const store = createStore(rootReducer, composeWithDevTools(applyMiddleware(thunk)))

</pre>
</code>
</li>
<li>edit /resources/js/app.js</li>
<li><code><pre>

require('./bootstrap');
import React from 'react';
import { render } from 'react-dom';
import { InertiaProgress } from '@inertiajs/progress';
import {App} from '@inertiajs/inertia-react'
import {Provider} from "react-redux";
import {store} from './reducers'
InertiaProgress.init({
color: '#ED8936',
showSpinner: true
});

const app = document.getElementById('app');

render(
<Provider store={store}>
<App
initialPage={JSON.parse(app.dataset.page)}
resolveComponent={name => require(`./Pages/${name}`).default}
/>
</Provider>,
app
);

</pre></code></li>
<li>create /utils/routesPath</li>
<li><code><pre>

export const PATH_HOME_PAGE = '/'
export const PATH_LOGIN_PAGE = '/login'
export const PATH_REGISTER_PAGE = '/register'
export const PATH_LOGOUT = '/logout'

</pre></code></li>
<li>create pages in js/Pages</li>
<li>Edit Login Page With all needed fields</li>
<li><code><pre>

```angular2html
import React, {useState} from 'react';
import {Button, Form} from "react-bootstrap";
import {Inertia} from "@inertiajs/inertia";

const LoginPage = () => {
    const [email, setEmail] = useState('')
    const [password, setPassword] = useState('')
    const [isRemember, setIsRemember] = useState(false)

    const submitHandler = (e) => {
        e.preventDefault()
        const fd = new FormData();
        fd.set('email', email)
        fd.set('password', password)
        fd.set('remember', isRemember)

        axios.post('/login', fd)
            .then(res => {
                console.log(res)
                if (res.status === 204) {
                    console.log('You are logged in')
                    Inertia.visit('/home')
                }
            })
            .catch(err => {
                console.log(err.response.data)
            });
    };

    return (
        <div>
            <h1>Login Page</h1>
            <div className="container">
                <div className="row justify-content-center">
                    <div className="card">
                        <Form onSubmit={submitHandler}>
                            <Form.Group className="mb-3" controlId="formBasicEmail">
                                <Form.Label>Email address</Form.Label>
                                <Form.Control
                                    type="email"
                                    name="email"
                                    value={email}
                                    placeholder="Enter email"
                                    onChange={event => setEmail(event.target.value)}
                                />
                                <Form.Text className="text-muted">
                                    We'll never share your email with anyone else.
                                </Form.Text>
                            </Form.Group>

                            <Form.Group className="mb-3" controlId="formBasicPassword">
                                <Form.Label>Password</Form.Label>
                                <Form.Control
                                    name="password"
                                    type="password"
                                    value={password}
                                    placeholder="Password"
                                    onChange={event => setPassword(event.target.value)}
                                />
                            </Form.Group>
                            <Form.Group className="mb-3" controlId="formBasicCheckbox">
                                <Form.Check
                                    type="checkbox"
                                    label="Check me out"
                                    name="remember"
                                    checked={isRemember}
                                    onChange={event => setIsRemember(event.target.checked)}
                                />
                            </Form.Group>
                            <Button variant="primary" type="submit">
                                Submit
                            </Button>
                        </Form>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default LoginPage;

```

</pre></code></li>
<li>create Admin Page&UserPage and all Cotrolers Page</li>
<li>app/Http/Controllers/Auth/LoginController.php</li>
<li><code><pre>/**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';
    <mark>public const DASHBOARD = '/admin-panel';</mark></pre></code></li>
<li>override methods in app/Http/Controllers/Auth/LoginController.php</li>
<li><code><pre>

protected $redirectTo = RouteServiceProvider::DASHBOARD;


...

public function showLoginForm()
{
return Inertia::render('LoginPage');
}
</pre></code></li>
<li>php artisan make:controller AdminPageController</li>
<li>create Page/LoginPage.js</li>

<li>create Layout component and past from view folder the same file and edit</li>

<li>Edit app/Http/Controllers/Auth/RegisterController.php</li>
<li><code><pre>
    public function showRegistrationForm(): \Inertia\Response
    {
        return Inertia::render('RegisterPage');
    }
</pre></code></li>
<li>create Page/RegisterPage.js</li>

<li>

```angular2html
import React, {useState} from 'react';
import {Inertia} from "@inertiajs/inertia";
import {Button, Form} from "react-bootstrap";

const RegisterPage = () => {
    const [name, setName] = useState('')
    const [email, setEmail] = useState('')
    const [password, setPassword] = useState('')
    const [passwordConfirm, setPasswordConfirm] = useState('')

    const submitHandler = (e) => {
        e.preventDefault()
        // console.log('email', email)
        // console.log('password', password)

        const fd = new FormData();
        fd.set('name', name)
        fd.set('email', email)
        fd.set('password', password)
        fd.set('password_confirmation', passwordConfirm)


        axios.post('/register', fd)
            .then(res => {
                console.log('register', res)
                if (res.status === 201) { // before was 204
                    // console.log('You are logged in')
                    Inertia.visit('/user-panel')
                }
            })
            .catch(err => {
                console.log(err.response.data)
            })
    };

    return (
        <div>
            <h1>Register Page</h1>
            <div className="container">
                <div className="row justify-content-center">
                    <div className="card">
                        <Form onSubmit={submitHandler}>
                            <Form.Group className="mb-3" controlId="formBasicEmail">
                                <Form.Label>Email address</Form.Label>
                                <Form.Control
                                    type="text"
                                    name="name"
                                    value={name}
                                    placeholder="Enter Email"
                                    onChange={event => setName(event.target.value)}
                                />
                                <Form.Text className="text-muted">
                                    We'll never share your name with anyone else.
                                </Form.Text>
                            </Form.Group>

                            <Form.Group className="mb-3" controlId="formBasicEmail">
                                <Form.Label>Email address</Form.Label>
                                <Form.Control
                                    type="email"
                                    name="email"
                                    value={email}
                                    placeholder="Enter email"
                                    onChange={event => setEmail(event.target.value)}
                                />
                                <Form.Text className="text-muted">
                                    We'll never share your email with anyone else.
                                </Form.Text>
                            </Form.Group>

                            <Form.Group className="mb-3" controlId="formBasicPassword">
                                <Form.Label>Password</Form.Label>
                                <Form.Control
                                    name="password"
                                    type="password"
                                    value={password}
                                    placeholder="Password"
                                    onChange={event => setPassword(event.target.value)}
                                />
                            </Form.Group>

                            <Form.Group className="mb-3" controlId="formBasicPassword">
                                <Form.Label>Password</Form.Label>
                                <Form.Control
                                    name="password_confirmation"
                                    type="password"
                                    value={passwordConfirm}
                                    placeholder="Password"
                                    onChange={event => setPasswordConfirm(event.target.value)}
                                />
                            </Form.Group>

                            <Button variant="primary" type="submit">
                                Submit
                            </Button>
                        </Form>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default RegisterPage;

```

</li>

<li>Create 404 page</li>

<li></li>


<li>Add role for users</li>
<li><a href="https://spatie.be/docs/laravel-permission/v5/introduction">https://spatie.be/docs/laravel-permission/v5/introduction</a></li>
<li>composer require spatie/laravel-permission</li>
<li>edit config/app.php</li>
<li><code><pre>
'providers' => [
    // ...
    Spatie\Permission\PermissionServiceProvider::class,
];
</pre></code></li>
<li>php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"</li>
<li>php artisan config:clear</li>
<li>php artisan migrate</li>
<li>php artisan permission:create-role user</li>
<li>php artisan permission:create-role admin</li>
<li>edit User model</li>
<li><code><pre>
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, <mark>HasRoles</mark>;
</pre></code></li>
<li>edit app/Http/Controllers/Auth/RegisterController.php</li>
<li><code><pre>
...

protected $redirectTo = RouteServiceProvider::USER_PAGE;

...

protected function create(array $data)
{
$user = User::create([
'name' => $data['name'],
'email' => $data['email'],
'password' => Hash::make($data['password']),
]);
<mark>$user->assignRole('user');</mark>
return $user;
}
</pre></code></li>
<li>php artisan make:controller UserPageController</li>
<li><code><pre>
class UserPageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return Inertia::render('UserPage', [
            'user' => $user
        ]);
    }
}
</pre></code></li>
<li>edit app/Http/Kernel.php</li>
<li><code><pre>
protected $routeMiddleware = [
    // ...
    'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
    'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
];
</pre></code></li>
<li>edit routes/web.php</li>
<li><code><pre>
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin-panel', [AdminPageController::class, 'index'])->name('admin-page');
});
</pre></code></li>
<li><a href="https://spatie.be/docs/laravel-permission/v5/basic-usage/new-app">Demo app with permission</a></li>
<li>Edit UserFactory</li>
<li><code><pre>
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'password' => \bcrypt('12345678'), // password
            'remember_token' => Str::random(10),
        ];
    }
</pre></code></li>
<li>Edit DatabaseSeeder</li>
<li><code><pre>
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

$user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => \bcrypt('secret')
        ]);

$user->assignRole($adminRole);
User::factory(100)->create()->each(function (User $user) use ($userRole) {
$user->assignRole($userRole);
});
}

</pre></code></li>
<li>edit $redirectTo in LoginController.php and RegisterController.php</li>
<li>add method in LoginController</li>
<li><code><pre>
...
    public function authenticated(Request $request, $user)
    {
        if ($user->hasRole('admin')) {
            $this->redirectTo = RouteServiceProvider::DASHBOARD;
        }
    }
</pre></code></li>

</ol>
