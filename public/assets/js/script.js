const deleteOutlet = () => {
   const form = $(event.target.form)[0];
   const outlet_id = $(event.target).data("outlet_id");

   if (confirm("Hapus outlet?")) {
      $(form).attr("action", "http://localhost:8080/outlet/" + outlet_id);
      $(form).submit();
   }
};

const deleteBarang = () => {
   const form = $(event.target.form)[0];
   const barang_id = $(event.target).data("barang_id");
   if (confirm("Hapus barang?")) {
      $(form).attr("action", "http://localhost:8080/barang/" + barang_id);
      $(form).submit();
   }
};

const removeMessage = () => {
   $("#message-toast").hide();
};

const showBarangs = () => {
   $("#list_barang").toggleClass("flex");
   $("#list_barang").toggleClass("hidden");
};

const debounce = (mainFunction, delay) => {
   // Declare a variable called 'timer' to store the timer ID
   let timer;

   // Return an anonymous function that takes in any number of arguments
   return function (...args) {
      // Clear the previous timer to prevent the execution of 'mainFunction'
      clearTimeout(timer);

      // Set a new timer that will execute 'mainFunction' after the specified delay
      timer = setTimeout(() => {
         mainFunction(...args);
      }, delay);
   };
};

const filterBarangs = () => {
   const value = $("#search_barang").val();
   $.ajax({
      type: "GET",
      url: `http://localhost:8080/filteredbarangs/${value}`,
      dataType: "HTML",
      success: (data) => {
         $("#list_barang").html(data);

         if (data.includes("Barang tidak ditemukan")) {
            $("#list_barang").addClass("text-center");
         }
      },
      error: () => {
         $("#list_barang").html("Terjadi error");
         $("#list_barang").addClass("text-center");
      },
   });
};

const debounceFilterBarangs = debounce(filterBarangs, 500);

$(".option-barang").change((event) => {
   const { target } = event;
   const targets = $("input[name='barang']:checked");
   if (target.checked) {
      $(`#display-${target.value}`).removeClass("hidden");
      $(`#display-${target.value}`).addClass("flex");
   } else {
      $(`#display-${target.value}`).removeClass("flex");
      $(`#display-${target.value}`).addClass("hidden");
   }

   if (targets.length) {
      $(`#selected-barangs`).removeClass("hidden");
      $(`#selected-barangs`).addClass("flex");
   } else {
      $(`#selected-barangs`).removeClass("flex");
      $(`#selected-barangs`).addClass("hidden");
   }
});
