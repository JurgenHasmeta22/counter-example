document.addEventListener("DOMContentLoaded", function () {
  const incrementButton = document.getElementById("increment-btn");
  const decrementButton = document.getElementById("decrement-btn");
  const resetButton = document.getElementById("reset-btn");

  incrementButton.addEventListener("click", function () {
    updateCount(1);
  });
  decrementButton.addEventListener("click", function () {
    updateCount(-1);
  });
  resetButton.addEventListener("click", function () {
    resetCount();
  });

  function updateCount(change) {
    const xhr = new XMLHttpRequest();

    xhr.open("POST", window.location.href);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200) {
        const count = document.getElementById("count");
        count.textContent = parseInt(xhr.responseText);
      }
    };

    xhr.send("counter=" + change);
  }

  function resetCount() {
    const xhr = new XMLHttpRequest();

    xhr.open("POST", window.location.href);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      if (xhr.status === 200) {
        const count = document.getElementById("count");
        count.textContent = parseInt(xhr.responseText);
      }
    };

    xhr.send("resetCounter=true");
  }
});
