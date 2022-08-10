$(document).ready(function () {
  // # platforms

  $(document).on("click", ".platform-pagination-pages", function (e) {
    e.preventDefault();
    let limit = $(this).data("limit");
    $.ajax({
      type: "get",
      url: "models/platforms/filter.php",
      data: { limit },
      dataType: "json",
      success: function (response) {
        const { platforms, pages } = response;
        printAllPlatfroms(platforms, limit);
        printPagination(
          pages,
          "platform-pagination",
          "platform-pagination-pages",
          limit
        );
      },
      error: (jqXHR, statusTxt, xhr) => {
        createResponseMessage(
          "danger",
          jqXHR.responseJSON,
          "platformResponseMessage"
        );
      },
    });
  });

  $(document).on("click", ".btn-edit-platform", function (e) {
    e.preventDefault();
    let id = $(this).data("id");
    let index = $(this).data("index");
    $.ajax({
      type: "get",
      url: "models/platforms/edit.php",
      data: { id },
      dataType: "json",
      success: (response) => {
        fillPlatformForm(response, index);
      },
      error: (jqXHR, statusTxt, xhr) => {
        console.log(jqXHR);
      },
    });
  });

  $(document).on("click", ".btn-delete-platform", function (e) {
    e.preventDefault();
    let id = $(this).data("id");
    let index = $(this).data("index");
    let status = $(this).data("deleted");
    let whereToPlace = `platform-row-${index}`;
    $.ajax({
      type: "post",
      url: "models/platforms/delete.php",
      data: { id, status },
      dataType: "json",
      success: (response) => {
        printPlatform(response, index, whereToPlace);
      },
      error: (jqXHR, statusTxt, xhr) => {
        console.log(jqXHR);
      },
    });
  });

  $(document).on("click", "#btnPlatformSave", function (e) {
    e.preventDefault();
    platformFormValidation();
  });

  $(document).on("click", "#btnResetPlatform", function () {
    clearPlatformForm();
  });

  // # publishers

  $(document).on("click", ".publisher-pagination-pages", function (e) {
    let limit = $(this).data("limit");
    $.ajax({
      method: "get",
      url: "models/publishers/filter.php",
      data: { limit },
      dataType: "json",
      success: (data) => {
        const { publishers, pages } = data;
        printAllPublishers(publishers, limit);
        printPagination(
          pages,
          "publisher-pagination",
          "publisher-pagination-pages",
          limit
        );
      },
      error: (jqXHR, statustTxt, xhr) => {
        console.log(jqXHR);
      },
    });
  });

  $(document).on("click", ".btn-edit-publisher", function (e) {
    e.preventDefault();
    let id = $(this).data("id");
    let index = $(this).data("index");
    $.ajax({
      method: "get",
      url: "models/publishers/edit.php",
      data: { id },
      dataType: "json",
      success: (data) => {
        fillPublisherForm(data, index);
      },
      error: (jqXHR, statusTxt, xhr) => {
        console.log(jqXHR);
      },
    });
  });

  $(document).on("click", ".btn-delete-publisher", function (e) {
    e.preventDefault();
    let id = $(this).data("id");
    let index = $(this).data("index");
    let status = $(this).data("status");
    $.ajax({
      type: "post",
      url: "models/publishers/delete.php",
      data: { id, status },
      dataType: "json",
      success: (response) => {},
      error: (jqXHR, statusTxt, xhr) => {
        console.log(jqXHR);
      },
    });
  });

  $(document).on("click", "#btnPublisherSave", function (e) {
    e.preventDefault();
    publisherFormValidation();
  });

  $(document).on("click", "#btnPublisherReset", function (e) {
    clearPublisherForm();
  });

  // # games

  $(document).on("click", ".game-pagination-pages", function (e) {
    e.preventDefault();
    let limit = $(this).data("limit");
    $.ajax({
      type: "post",
      url: "models/games/filter.php",
      data: { limit },
      dataType: "json",
      success: function (data) {
        console.log(data);
      },
      error: (jqXHR, statusTxt, xhr) => {
        console.log(jqXHR);
      },
    });
  });
});

// # platforms
let printAllPlatfroms = (platforms, limit = 0) => {
  let content = "",
    index = 1;

  if (limit != 0) {
    index = parseInt(limit) * index + 1;
  }

  platforms.forEach((platform) => {
    content += printPlatform(platform, index);
  });

  document.querySelector("#platforms").innerHTML = content;
};

let printPlatform = (platform, index, whereToPlace = "") => {
  let showButtonText = platform.is_deleted == 0 ? "Delete" : "Restore";
  let content = `
  <tr id='platform-row-${index}'>
  <th scope="row">${index}</th>
  <td>${platform.name}</td>
  <td>${dateFormater(platform.created_at)}</td>
  <td>${
    platform.updated_at != null ? dateFormater(platform.updated_at) : "-"
  }</td>
  <td><button class="btn btn-sm btn-success btn-edit-platform" data-id=' ${
    platform.id
  }' data-index='${index}' type='button'>Edit</button></td>
  <td><button class="btn btn-sm btn-danger btn-delete-platform" data-id='${
    platform.id
  }' data-index='${index}' data-deleted = "${platform.is_deleted}">
          ${showButtonText}
      </button></td>
</tr>
  `;
  if (whereToPlace != "") {
    document.querySelector(`#${whereToPlace}`).innerHTML = content;
  }
  return content;
};

let fillPlatformForm = (platform, index) => {
  document.querySelector("#platform-name").value = platform.name;
  document.querySelector("#platform-id").value = platform.id;
  document.querySelector("#platform-index").value = index;
};

let platformFormValidation = () => {
  let id = document.querySelector("#platform-id").value;
  let index = document.querySelector("#platform-index").value;
  let name = document.querySelector("#platform-name").value;

  let errors = [];
  let re_name = "";
  if (name == "") {
    errors.push("Name isn't ok");
    createErrorMessage("platform-name-error", classes, "Name isn't ok");
  } else {
    removeErrorMessage("platform-name-error", classes);
  }

  if (errors.length == 0) {
    if (id == "") {
      $.ajax({
        type: "post",
        url: "models/platforms/store.php",
        data: { name },
        dataType: "json",
        success: (response) => {
          const { platforms, pages } = response;
          printAllPlatfroms(platforms);
          printPagination(
            pages,
            "platform-pagination",
            "platform-pagination-pages"
          );
          clearPlatformForm();
        },
        error: (jqXHR, statustTxt, xhr) => {
          createResponseMessage(
            "danger",
            jqXHR.responseJSON,
            "platformResponseMessage"
          );
        },
      });
    } else {
      let whereToPlace = `platform-row-${index}`;
      $.ajax({
        type: "post",
        url: "models/platforms/update.php",
        data: { name, id },
        dataType: "json",
        success: (platform) => {
          printPlatform(platform, index, whereToPlace);
          clearPlatformForm();
        },
        error: (jqXHR, statusTxt, xhr) => {
          createResponseMessage(
            "danger",
            jqXHR.responseJSON,
            "platformResponseMessage"
          );
        },
      });
    }
  }
};

let clearPlatformForm = () => {
  document.querySelector("#platform-name").value = "";
  document.querySelector("#platform-id").value = "";
  document.querySelector("#platform-index").value = "";
};

// # publishers

let fillPublisherForm = (publisher, index) => {
  document.querySelector("#publisher-id").value = publisher.id;
  document.querySelector("#publisher-index").value = index;
  document.querySelector("#publisher-name").value = publisher.name;
};

let printAllPublishers = (publishers, limit = 0) => {
  let content = "",
    index = 1;
  if (index != 0) {
    index = parseInt(index * limit) + 1;
  }

  publishers.forEach((publisher) => {
    content += printPublisher(publisher, index);
    index++;
  });

  document.querySelector("#publishers").innerHTML = content;
};

let printPublisher = (publisher, index, whereToPlace = "") => {
  let textToShow = publisher.is_deleted == 0 ? "Delete" : "Restore";
  let content = `
  <tr id='publisher-row-${index}'>
  <th scope="row">${index}</th>
  <td>${publisher.name}</td>
  <td>${dateFormater(publisher.created_at)}</td>
  <td>${
    publisher.updated_at != null ? dateFormater(publisher.updated_at) : "-"
  }</td>
  <td><button class="btn btn-sm btn-success btn-edit-publisher" data-id='${
    publisher.id
  }' data-index='${index}' type='button'>Edit</button></td>
  <td><button class="btn btn-sm btn-danger btn-delete-publisher" data-id='${
    publisher.id
  }' data-index='${index}' data-deleted='${publisher.is_deleted}'>
         ${textToShow}
      </button></td>
</tr>
  `;
  if (whereToPlace != "") {
    document.querySelector(`#${whereToPlace}`).innerHTML = content;
  }
  return content;
};

let publisherFormValidation = () => {
  let name = document.querySelector("#publisher-name").value;
  let id = document.querySelector("#publisher-id").value;
  let index = document.querySelector("#publisher-index").value;

  let errors = [];
  let re_name = "";
  if (name == "") {
    errors.push(name);
    createErrorMessage(
      "publisher-name-error",
      classes,
      "Name for the publisher isn't ok"
    );
  } else {
    removeErrorMessage("publisher-name-error", classes);
  }

  if (errors.length == 0) {
    if (id == "") {
      $.ajax({
        method: "post",
        url: "models/publishers/store.php",
        data: { name },
        dataType: "json",
        success: (data) => {
          const { publishers, pages } = data;
          printAllPublishers(publishers);
          printPagination(
            pages,
            "publisher-pagination",
            "publisher-pagination-pages"
          );
          clearPublisherForm();
        },
        error: (jqXHR, statusTxt, xhr) => {
          createResponseMessage(
            "danger",
            jqXHR.responseJSON,
            "publisherResponseMessage"
          );
        },
      });
    } else {
      let whereToPlace = `publisher-row-${index}`;
      console.log(whereToPlace);
      $.ajax({
        method: "post",
        url: "models/publishers/update.php",
        data: { id, name },
        success: (data) => {
          clearPublisherForm();
          printPublisher(data, index, whereToPlace);
        },
        error: (jqXHR, statusTxt, xhr) => {
          createResponseMessage(
            "danger",
            jqXHR.responseJSON,
            "publisherResponseMessage"
          );
        },
      });
    }
  }
};

let clearPublisherForm = () => {
  document.querySelector("#publisher-id").value = "";
  document.querySelector("#publisher-index").value = "";
  document.querySelector("#publisher-name").value = "";
};

// # games
