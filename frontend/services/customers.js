var CustomersService = {
  populate_customers: function () {
    RestClient.get("customers", (data) => {
      const customersList = $("#customers-list");
      customersList.empty();
      customersList.append(
        "<option selected>Please select one customer</option>"
      );

      data.forEach(({ first_name, last_name, id }) => {
        const item = $("<option></option>")
          .text(`${first_name} ${last_name}`)
          .val(id);
        customersList.append(item);
      });
    });
  },

  customer_fetch: function () {
    RestClient.get("customers", (data) => {
      const c = document.getElementById("customers-list");
      c.innerHTML = "";
      data.forEach((cus) => {
        const option = document.createElement("option");
        option.value = cus.id;
        option.textContent = `${cus.first_name} ${cus.last_name}`;
        c.appendChild(option);
      });
    });
  },
  customer_fetch1: function () {
    RestClient.get("customers", (data) => {
      const c = document.getElementById("customers-list");
      let optionsHtml = "<option selected>Please select one customer</option>";
      data.forEach((cus) => {
        optionsHtml += `<option value="${cus.id}">${cus.first_name} ${cus.last_name}</option>`;
      });
      c.innerHTML = optionsHtml;
    });
  },

  fetch_meals: function (customer_id) {
    RestClient.get("customer/meals/" + customer_id, (data) => {
      const customer_meals = document.getElementById("customer-meals");
      // Ensure the table element has the 'table' and 'table-striped' classes
      let thead = `<thead>
        <tr>
          <th>Food name</th>
          <th>Food brand</th>
          <th>Meal date</th>
        </tr>
      </thead>`;
      let tbody = "";
      data.forEach((cus) => {
        tbody += `
            <tr>
              <td>${cus.food_name}</td>
              <td>${cus.food_brand}</td>
              <td>${cus.meal_date}</td>
            </tr>
            `;
      });
      customer_meals.innerHTML = thead + tbody;
    });
  },
};
