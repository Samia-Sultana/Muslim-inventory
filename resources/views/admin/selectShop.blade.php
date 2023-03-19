<div>
  <button id="gold-btn">Gold</button>
  <button id="diamond-btn">Diamond</button>
</div>

<script>
  // Get references to the buttons
  const goldBtn = document.getElementById("gold-btn");
  const diamondBtn = document.getElementById("diamond-btn");

  // Add click event listeners to the buttons
  goldBtn.addEventListener("click", function() {
    window.location.href = "/dashboard";
  });

  diamondBtn.addEventListener("click", function() {
    window.location.href = "diamond/dashboard";
  });
</script>