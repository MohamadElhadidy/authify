<x-mail::message>
{{-- Logo --}}
<div style="text-align: center; margin-bottom: 20px;">
    <img src="https://i.postimg.cc/T1xRQjfB/logo.png" alt="{{ config('app.name') }} Logo" style="height: 60px;">
</div>

# 🔐 Hello {{ $email }}

We received a request to reset your password.

Click the button below to set a new password and regain access to your account:

<x-mail::button :url="$url">
Reset Password
</x-mail::button>

---

### ⚠️ Didn't request this?

If you didn't ask to reset your password, you can safely ignore this message.  
No changes will be made to your account.

---

Thanks,<br>
🛡️ **{{ config('app.name') }} Team**

<x-slot:subcopy>
If you're having trouble clicking the "Reset Password" button, copy and paste this URL into your browser:

<span style="color: grey;">{{ $url }}</span>
</x-slot:subcopy>
</x-mail::message>
