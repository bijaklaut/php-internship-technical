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
