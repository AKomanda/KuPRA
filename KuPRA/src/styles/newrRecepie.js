$("document").ready(function() {
	$(".add").click(function() {
		$(".row").eq(-1).clone(true).appendTo(".productsContainer").find("input[type='text']").val("");
		$(".add").eq(-2).off("click");
		$(".add").eq(-2).bind("click", function() {
			$(this).closest(".row").remove();
		})
		$(".add").eq(-2).val("-");
		$(".add").eq(-2).attr("name", "del");
		$(".add").eq(-2).removeClass("add").addClass("del");
	});
	
});