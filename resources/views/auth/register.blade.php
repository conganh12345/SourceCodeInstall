<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        form {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form method="POST" action="{{ url('/auth/register') }}">
        @csrf

        <div>
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name"  value="{{old('first_name')}}"/>
        </div>
        {{-- error để hiện lỗi validate --}}

        @error('first_name')
                    <span style="color: red">{{$message}}</span>
        @enderror

        <div>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" value="{{old('last_name')}}"/>
        </div>

        @error('last_name')
                    <span style="color: red">{{$message}}</span>
        @enderror

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{old('email')}}"/>
        </div>

        @error('email')
                    <span style="color: red">{{$message}}</span>
        @enderror

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="{{old('password')}}"/>
        </div>

        @error('password')
                    <span style="color: red">{{$message}}</span>
        @enderror



        <div>
            <button type="submit">Register</button>
        </div>
    </form>
</body>
</html>
