const showError = (errors, alertId) => {
  const alert = document.querySelector(`#${alertId}`);
  const textElement = alert.querySelector("span");

  textElement.innerHTML = "";
  Object.getOwnPropertyNames(errors).map(field => {
    textElement.innerHTML += `${field}: ${errors[field]}<br>`;
  });

  alert.classList.add("open");
}
