@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            <h2 class="text-center fw-bold mb-4 privacy-policy-title">Privacy Policy</h2>
        </div>
        <div class="card shadow-sm p-4 mb-5">
            <h4 class="info-title">Information We Collect</h4>
            <p class="info-content">We collect your name, email address, password, and your booking history.</p>

            <h4 class="info-title">How We Use Your Information</h4>
            <p class="info-content">Your information is used to authenticate your account, manage your bookings, 
               and allow organisers to verify attendance. We do not share your data with third parties for marketing.</p>

            <h4 class="info-title">Data Security</h4>
            <p class="info-content">Your password is securely stored using hashing, and access is restricted by role-based permissions 
               to protect against unauthorised access.</p>

            <h4 class="info-title">Your Rights</h4>
            <p class="info-content">You may view, update, or request deletion of your data at any time by contacting the system administrator.</p>
        </div>
    </div>
@endsection