<x-mail::message>
<div style="text-align: center; margin-bottom: 20px;">
    <img src="https://i.postimg.cc/T1xRQjfB/logo.png" alt="{{ config('app.name') }} Logo" style="height: 60px;">
</div>

# 👋 Hello {{ $user->name }}

We're excited to have you on board!

Please confirm your email address to activate your account:

<x-mail::button :url="$url">
Verify Email Address
</x-mail::button>

---

If you didn't sign up, no further action is required.

Thanks,<br>
🛡️ **{{ config('app.name') }} Team**

<x-slot:subcopy>
If you're having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser:

<span style="color: grey;">{{ $url }}</span>
</x-slot:subcopy>
</x-mail::message>
