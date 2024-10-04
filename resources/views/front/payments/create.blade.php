<x-front-layout title="order payment">
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div style="display:none" id="payment-message"></div>

                    <form action="" method="post" id="payment-form">
                        <div id="payment-element"></div>
                        <button type="submit" id="submit" class="btn">
                            <span id="spinner" style="display: none;">Loading...</span>
                            <span id="button-text">pay now</span>
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ config('services.stripe.publish_key') }}");
        let elements;

        initialize();

        document.querySelector("#payment-form").addEventListener("submit", handleSubmit);

        async function initialize() {
            const response = await fetch("{{ route('createPaymentStripe', $order->id) }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    "_token": "{{ csrf_token() }}"
                }),
            });

            const { clientSecret, dpmCheckerLink } = await response.json(); // استخدم response هنا

            console.log("Client Secret:", clientSecret); // طباعة clientSecret للتحقق

            elements = stripe.elements({
                clientSecret // استخدام clientSecret هنا
            });

            const paymentElement = elements.create("payment");
            paymentElement.mount("#payment-element");
        }

        async function handleSubmit(e) {
            e.preventDefault();
            setLoading(true);

            const { error } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: "{{ route('stripe.return', $order->id) }}",
                },
            });

            if (error) {
                showMessage(error.message);
            } else {
                showMessage("An unexpected error occurred.");
            }

            setLoading(false);
        }

        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");
            messageContainer.style.display = "block";
            messageContainer.textContent = messageText;

            setTimeout(() => {
                messageContainer.style.display = "none";
                messageContainer.textContent = "";
            }, 4000);
        }

        function setLoading(isLoading) {
            if (isLoading) {
                document.querySelector("#submit").disabled = true;
                document.querySelector("#spinner").style.display = "inline";
                document.querySelector("#button-text").style.display = "none";
            } else {
                document.querySelector("#submit").disabled = false;
                document.querySelector("#spinner").style.display = "none";
                document.querySelector("#button-text").style.display = "inline";
            }
        }
    </script>
</x-front-layout>
