
<div style="width: 500px;
margin: 0 auto;
padding: 15px;
text-align: center">
   <h2>Email này để giúp bạn lấy lại mật khẩu đã bị quên</h2>
        <p>Vui lòng click vào link dưới đây để đặt lại mật khẩu</p>
    <button><a href="{{ route('auth.getpass' , $account->email) }}">Lấy lại mật khẩu</a>  </button>

</div>
