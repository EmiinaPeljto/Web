var FoodsService = {
  get_foods_reportt: function () {
    RestClient.get("foods/report", (data) => {
      const foods = document.getElementById("food-report");
      let table_body = "";
      data.forEach((food) => {
        table_body += `<tr>
          <td>
            <button class="btn btn-danger" onclick = "FoodsService.delete_food(${food.id})">
              Delete
            </button>
          </td>
          <td>${food.name}</td>
          <td>${food.brand}</td>
          <td class="text-center">
            <img src="${food.image_url}" height="50" />
          </td>
          <td>${food.Energy}</td>
          <td>${food.Protein}</td>
          <td>${food.Fat}</td>
          <td>${food.Fiber}</td>
          <td>${food.Carbs}</td>
        </tr>`;
      });
      foods.innerHTML = table_body;
    });
  },

  get_foods: function () {
    RestClient.get("foods", (data) => {
      const foods = document.getElementById("all-foods");
      let table_body = "";
      data.forEach((food) => {
        table_body += `<tr>
          <td>
            <button class="btn btn-danger" onclick = "FoodsService.delete_food(${food.id})">
              Delete
            </button>
            <button class="btn btn-secondary" onclick = "">
              Update
            </button>
          </td>
          <td>${food.name}</td>
          <td>${food.brand}</td>
          <td class="text-center">
            <img src="${food.image_url}" height="50" />
          </td>
        </tr>`;
      });
      foods.innerHTML = table_body;
    });
  },

  delete_food: function (food_id) {
    if (confirm("Are you sure you want to delete this food?")) {
      RestClient.delete(
        "delete/" + food_id,
        {},
        function (data) {
          FoodsService.get_foods();
          toastr.success("Food deleted successfully");
        },
        function (error) {
          toastr.error("Failed to delete food");
        }
      );
    }
  },
};
