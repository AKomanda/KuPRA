var fetchMeasures = function(loc) {
	var smt = loc;
	var searchid = $(loc).val();
	var dataString = 'search=' + searchid;
	
		$.ajax({
			type : "POST",
			url : "./ajax/fetchMeasures.php",
			data : dataString,
			cache : false,
			success : function(html) {
				$(smt).closest("tr").find("#mat").html(html).show();
			}
		});
	
	return false;
}

$(document).ready(
		function() {
//			
//			$(".del").on("click", function() {
//						$(this).unbind();
//						$(this).closest(".row").remove();
//			});
			
			$('.prod').each(function(){
				fetchMeasures(this);
			});

			$(".add").click(
					function() {
						var row = $(".row").eq(-1).clone(true).appendTo(
								".productsContainer");
						$(row).find("input[type='text']").val("");
						$(row).find("input[type='number']").val('0.01');
						$(row).find("select[id='mat']")
							  .find('option')
							  .remove()
							  .end()
							  .append('<option value="0">Matavimo vienetas</option>')
							  .val('0');
					});
			
			$(".del").click(
					function(){
						var numItems = $('.product').length;
						if(numItems > 1 ){
							$(this).closest(".row").remove();
						}
					});

			$("#searchid").keyup(function() {
				var smt = this;
				var searchid = $(this).val();
				var dataString = 'search=' + searchid;
				if (searchid != '') {
					$.ajax({
						type : "POST",
						url : "./ajax/fetchProducts.php",
						data : dataString,
						cache : false,
						success : function(html) {
							$(smt).next().html(html).show();
						}
					});
				}
				return false;
			});

			$("#searchid").keyup(function() {
				fetchMeasures(this);
			});

			$("#searchid").click(function() {
				fetchMeasures(this);
			});

			$('#result').click(function(e) {
				var txt = $(e.target).text().replace('\t', '');
				if ($(e.target).is("strong")) {
					var txt = $(e.target).parent().text().replace('\t', '');
				}
				$(this).prev().val(txt);
				$(this).fadeOut();
				fetchMeasures($(this).prev());
			});

			$(document).on("click", function(e) {
				var $clicked = $(e.target);
				$(this).find(".result").fadeOut();
			});

			$('#searchid').on(function() {
				$("#result").fadeIn();
			});

			$(function() {
				$("input:file").change(function() {
					var fileName = $(this).val();
					$(".filename").html(fileName);
				});
			});

		});
