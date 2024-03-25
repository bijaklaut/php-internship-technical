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

const barangHandler = (event) => {
   const { target } = event;
   const kode_barang = $(target).data("kode_barang");
   const targets = $("input.option-barang:checked");
   const qtyInput = $(`#qty-${kode_barang}`)[0];

   if (target.checked) {
      $(`#display-${kode_barang}`).removeClass("hidden");
      $(`#display-${kode_barang}`).addClass("flex");
      qtyInput.value = 1;
   } else {
      $(`#display-${kode_barang}`).removeClass("flex");
      $(`#display-${kode_barang}`).addClass("hidden");
      qtyInput.value = 0;
   }

   calculate();

   if (targets.length) {
      $(`#selected-barangs`).removeClass("hidden");
      $(`#selected-barangs`).addClass("flex");
   } else {
      $(`#selected-barangs`).removeClass("flex");
      $(`#selected-barangs`).addClass("hidden");
   }
};

const calculate = () => {
   const qtyInputs = $(`.qty-input`);
   let amount = 0;
   const discount = $("#discount").val();

   qtyInputs.each((i, obj) => {
      amount += $(obj).data("harga") * obj.value;
   });

   let ppn = amount * 0.1;

   let totalAmount = amount + ppn - discount;

   $("#amount").val(amount);
   $("#ppn").val(ppn);
   $("#total_amount").val(totalAmount);
   $("#discount").attr("max", amount);
};

$(".qty-input").change(calculate);
$("#discount").change((event) => {
   const { max, min, value } = event.target;
   $("#discount").val(Math.min(max, Math.max(min, value)));
   calculate();
});

$("#discount").ready(() => {
   $("discount").attr("max", $("#amount").val());
});

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
         if (data.includes("Barang tidak ditemukan")) {
            $("#list_barang").addClass("text-center");
         }

         $("#list_barang").html(data);

         $(".option-barang").each((i, obj) => {
            if ($(`#display-${obj.value}`).hasClass("flex")) {
               obj.checked = true;
            }

            if ($(`#display-${obj.value}`).hasClass("hidden")) {
               obj.checked = false;
            }
         });

         $(".option-barang").change(barangHandler);
      },
      error: () => {
         $("#list_barang").html("Terjadi error");
         $("#list_barang").addClass("text-center");
      },
   });
};

const debounceFilterBarangs = debounce(filterBarangs, 500);

$(".option-barang").change(barangHandler);

// $(".option-barang").ready(() => {
//    $(".option-barang").each((i, obj) => {
//       console.log("this: ", $(`#display-${obj.value}`).hasClass("flex"));

//       if ($(`#display-${obj.value}`).hasClass("flex")) {
//          obj.checked = true;
//       }

//       if ($(`#display-${obj.value}`).hasClass("hidden")) {
//          obj.checked = false;
//       }
//    });
// });
