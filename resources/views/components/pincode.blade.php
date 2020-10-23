<div x-data x-init="setTimeout(() => {$refs.pin1.focus();}, 40)">
    <div class="flex justify-center items-center mx-auto my-0">
        <div class="mx-2">
            <input id="pin1" x-ref="pin1" @keyup="validatePinCode($event, $refs.pin2)" type="number" pattern="\d*" class="w-16 h-16 text-center text-gray-800 border border-gray-800 text-2xl" maxlength="1">
        </div>
        <div class="mx-2">
            <input id="pin2" x-ref="pin2" @keyup="validatePinCode($event, $refs.pin3)" type="number" pattern="\d*" class="w-16 h-16 text-center text-gray-800 border border-gray-800 text-2xl" maxlength="1">
        </div>
        <div class="mx-2">
            <input id="pin3" x-ref="pin3" @keyup="validatePinCode($event, $refs.pin4)" type="text" pattern="\d*" class="w-16 h-16 text-center text-gray-800 border border-gray-800 text-2xl" maxlength="1">
        </div>
        <div class="mx-2">
            <input id="pin4" x-ref="pin4" @keyup="validatePinCode($event, $refs.pin5)" type="text" pattern="\d*" class="w-16 h-16 text-center text-gray-800 border border-gray-800 text-2xl" maxlength="1">
        </div>
        <div class="mx-2">
            <input id="pin5" x-ref="pin5" @keyup="validatePinCode($event, $refs.pin6)" type="text" pattern="\d*" class="w-16 h-16 text-center text-gray-800 border border-gray-800 text-2xl" maxlength="1">
        </div>
        <div class="mx-2">
            <input id="pin6" x-ref="pin6" @keyup="submitPin()" type="text" pattern="\d*" class="w-16 h-16 text-center text-gray-800 border border-gray-800 text-2xl" maxlength="1">
        </div>
    </div>
    <form id="pin_form" method="POST" action="{{ route('viezel.otp.verify_identity') }}">
        @csrf
        <input id="code" type="hidden" name="code">
        <input id="url" type="hidden" name="url" value="{{ session('otp_url') }}">
    </form>
    <script>
        function validatePinCode(event, next) {
            if(event.key === 'Tab' || event.key === 'Enter') {
                return;
            }
            var element = event.target;
            element.value = element.value.replace(/\D+/g, '');
            if(element.value.length > 1) {
                element.value = element.value.substr(0, 1);
            }
            if(element.value.length === 1) {
                next.focus();
            }
        }
        function submitPin(){
            if( document.getElementById('pin1').value.length === 1 &&
                document.getElementById('pin2').value.length === 1 &&
                document.getElementById('pin3').value.length === 1 &&
                document.getElementById('pin4').value.length === 1 &&
                document.getElementById('pin5').value.length === 1 &&
                document.getElementById('pin6').value.length === 1)
            {
                // submit the pin
                document.getElementById("code").value = document.getElementById('pin1').value +
                    document.getElementById('pin2').value +
                    document.getElementById('pin3').value +
                    document.getElementById('pin4').value +
                    document.getElementById('pin5').value +
                    document.getElementById('pin6').value;
                document.getElementById("pin_form").submit();

                return;
            }
        }
    </script>
</div>
