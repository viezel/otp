<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Verify Identity</title>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body>
    <div class="fixed inset-x-0 px-4 pb-6 inset-0 p-0 flex items-center justify-center">
        <div class="overflow-hidden transform transition-all sm:max-w-3xl sm:w-full sm:p-16">
            <div>
                <div class="text-center sm:mt-5">
                    <h3 class="text-3xl leading-10 font-medium text-gray-500">
                        Verify your identify
                    </h3>

                    <x-otp-pincode></x-otp-pincode>

                    @if (session('errors'))
                        <div class="mt-6">
                            <div class="flex justify-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-2">
                                    <p class="text-sm leading-5 text-red-400">
                                        The verification code is invalid
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <p class="mt-10 text-lg text-gray-200">An email with a verification code has been sent you.<br>Enter the code to continue.</p>
                    <a class="mt-6 block text-blue-500 cursor-pointer underline" href="{{ route('viezel.otp.verify_identity.resend') }}">Resend verification code</a>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
