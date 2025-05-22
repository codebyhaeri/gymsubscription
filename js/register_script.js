document.addEventListener("DOMContentLoaded", function () {
  const steps = document.querySelectorAll(".step");
  const nextBtn = document.getElementById("nextBtn");
  const prevBtn = document.getElementById("prevBtn");
  const form = document.getElementById("fitlifeForm");
  const progressSteps = document.querySelectorAll(".progress-step");
  const password = document.getElementById("s_password");
  const confirmPassword = document.getElementById("s_conf_password");
  const passwordMsg = document.getElementById("passwordMsg");

  let currentStep = 0;

  function showStep(n) {
    steps.forEach((step, i) => {
      step.classList.toggle("active", i === n);
    });

    progressSteps.forEach((step, i) => {
      step.classList.toggle("bg-light", i <= n);
      step.classList.toggle("bg-gray-300", i > n);
    });

    prevBtn.disabled = n === 0;
    prevBtn.classList.toggle("opacity-50", n === 0);
    prevBtn.classList.toggle("cursor-not-allowed", n === 0);

    nextBtn.textContent = (n === steps.length - 1) ? "Submit" : "Next";
  }

  function validateStep() {
    const inputs = steps[currentStep].querySelectorAll("input, select, textarea");
    for (let input of inputs) {
      if (!input.checkValidity()) {
        input.reportValidity();
        return false;
      }
    }

    // Special case: password match
    if (currentStep === 0 && password.value !== confirmPassword.value) {
      passwordMsg.textContent = "Passwords do not match.";
      confirmPassword.setCustomValidity("Passwords do not match");
      confirmPassword.reportValidity();
      return false;
    } else {
      passwordMsg.textContent = "";
      confirmPassword.setCustomValidity("");
    }

    return true;
  }

  nextBtn.addEventListener("click", () => {
    if (!validateStep()) return;

    if (currentStep < steps.length - 1) {
      currentStep++;
      showStep(currentStep);
    } else {
      form.submit();
    }
  });

  prevBtn.addEventListener("click", () => {
    if (currentStep > 0) {
      currentStep--;
      showStep(currentStep);
    }
  });

  if (password && confirmPassword) {
    confirmPassword.addEventListener("input", () => {
      if (password.value !== confirmPassword.value) {
        passwordMsg.textContent = "Passwords do not match.";
      } else {
        passwordMsg.textContent = "";
      }
    });
  }

  // Initial render
  showStep(currentStep);
});

if (currentStep === steps.length - 1) {
  nextBtn.textContent = "Submit";
  nextBtn.type = "submit";
} else {
  nextBtn.textContent = "Next";
  nextBtn.type = "button";
}

