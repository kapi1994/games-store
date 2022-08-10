let classes = ["fw-bold", "text-danger", "mt-3"];

const createErrorMessage = (elementId, classes, textMessage) => {
  let element = document.querySelector(`#${elementId}`);
  element.classList.add(...classes);
  element.textContent = textMessage;
};

const removeErrorMessage = (elementId, classes) => {
  let element = document.querySelector(`#${elementId}`);
  element.classList.remove([...classes]);
  element.textContent = "";
};

const createResponseMessage = (color, textMessage, whereToPlace) => {
  let content = `<div class="alert alert-${color} alert-dismissible fade show" role="alert">
 ${textMessage}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`;
  document.querySelector(`#${whereToPlace}`).innerHTML = content;
};

const dateFormater = (datetime) => {
  const dateTime = datetime.split(" ");
  const time = dateTime[1];
  const date = dateTime[0].split("-");
  const finalDate = date[2] + "/" + date[1] + "/" + date[0] + " " + time;
  return finalDate;
};

const printPagination = (pages, whereToPlace, cls, limit = 0) => {
  let content = ``;

  let lim = 1;

  if (limit) {
    lim += parseInt(limit);
  }
  for (let i = 0; i < pages; i++) {
    content += ` <li class="page-item ${
      lim == i + 1 ? "active" : ""
    }"><a class="page-link ${cls}" href="#" data-limit="${i}">${
      i + 1
    }</a></li>`;
  }

  document.querySelector(`#${whereToPlace}`).innerHTML = content;
};
