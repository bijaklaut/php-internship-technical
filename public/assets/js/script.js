const deleteOutlet = () => {
   const form = $(event.target.form)[0];
   const outlet_id = $(event.target).data("outlet_id");
   $(form).attr("action", "http://localhost:8080/outlet/" + outlet_id);

   if (confirm("Hapus Segmen?")) {
      $(form).submit();
   }
};
