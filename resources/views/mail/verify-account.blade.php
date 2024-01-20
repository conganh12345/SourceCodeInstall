
<div style="width: 500px;
margin: 0 auto;
padding: 15px;
text-align: center">
   <h2>Cảm ơn bạn đã đăng ký</h2>

    <button><a href="{{ url('/auth/verify-account/' . $account->email) }}">Xác thực tài khoản</a>  </button>
    <br><br>
    <a href="{{ url('/auth/noverify-account/' . $account->email) }}">Từ chối xác thực</a>
</div>
