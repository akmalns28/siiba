@extends('layout.main')
@section('container')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form id="multi-step-form" action="#" method="POST">
                <!-- Step 1 -->
                <div class="step">
                    <h2>Step 1</h2>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <button class="btn btn-primary next" type="button">Next</button>
                </div>
                
                <!-- Step 2 -->
                <div class="step">
                    <h2>Step 2</h2>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button class="btn btn-primary prev" type="button">Previous</button>
                    <button class="btn btn-primary next" type="button">Next</button>
                </div>
                
                <!-- Step 3 -->
                <div class="step">
                    <h2>Step 3</h2>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" required></textarea>
                    </div>
                    <button class="btn btn-primary prev" type="button">Previous</button>
                    <button class="btn btn-primary next" type="button">Next</button>
                </div>
                
                <!-- Final Step -->
                <div class="step">
                    <h2>Final Step</h2>
                    <p>Thank you for submitting the form.</p>
                    <button class="btn btn-primary prev" type="button">Previous</button>
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var form = document.getElementById("multi-step-form");
        var steps = form.getElementsByClassName("step");
        var prevBtns = form.getElementsByClassName("prev");
        var nextBtns = form.getElementsByClassName("next");
        var currentStep = 0;

        showStep(currentStep);

        function showStep(stepIndex) {
            for (var i = 0; i < steps.length; i++) {
                steps[i].style.display = "none";
            }
            steps[stepIndex].style.display = "block";

            if (stepIndex === 0) {
                prevBtns[0].style.display = "none";
            } else {
                prevBtns[0].style.display = "inline-block";
            }

            if (stepIndex === steps.length - 1) {
                nextBtns[stepIndex].style.display = "none";
            } else {
                nextBtns[stepIndex].style.display = "inline-block";
            }
        }

        function goToStep(stepIndex) {
            if (stepIndex >= 0 && stepIndex < steps.length) {
                currentStep = stepIndex;
                showStep(currentStep);
            }
        }

        function nextStep() {
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        }

        function prevStep() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        }

        form.addEventListener("submit", function(e) {
            e.preventDefault();
            alert("Form submitted successfully!");
            // TODO: Handle form submission
        });

        for (var i = 0; i < nextBtns.length; i++) {
            nextBtns[i].addEventListener("click", nextStep);
        }

        for (var i = 0; i < prevBtns.length; i++) {
            prevBtns[i].addEventListener("click", prevStep);
        }
    });
</script>
@endpush

