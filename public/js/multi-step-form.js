$(document).ready(function() {
    var steps = $('.step');
    var currentStep = 0;

    steps.hide();
    steps.eq(currentStep).show();

    $('#nextBtn1').click(function() {
        if (currentStep < steps.length + 1) {
            steps.eq(currentStep).hide();
            currentStep++;
            steps.eq(currentStep).show();
            updateProgressBar();
        }
    });

    $('#prevBtn2').click(function() {
        if (currentStep > 0) {
            steps.eq(currentStep).hide();
            currentStep--;
            steps.eq(currentStep).show();
            updateProgressBar();
        }
    });

    $('#nextBtn2').click(function() {
        if (currentStep < steps.length + 1) {
            steps.eq(currentStep).hide();
            currentStep++;
            steps.eq(currentStep).show();
            updateProgressBar();
        }
    });

    $('#prevBtn3').click(function() {
        if (currentStep > 0) {
            steps.eq(currentStep).hide();
            currentStep--;
            steps.eq(currentStep).show();
            updateProgressBar();
        }
    });

    $('#nextBtn3').click(function() {
        if (currentStep < steps.length + 1) {
            steps.eq(currentStep).hide();
            currentStep++;
            steps.eq(currentStep).show();
            updateProgressBar();
        }
    });

    function updateProgressBar() {
        var progressBar = $('.progress-bar');
        var progress = (currentStep + 1) / steps.length * 100;
        progressBar.css('width', progress + '%');
        progressBar.attr('aria-valuenow', progress);
    }
});