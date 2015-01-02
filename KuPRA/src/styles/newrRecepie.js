var fetchMeasures = function(loc) {
	var smt = loc;
	var searchid = $(loc).val();
	var dataString = 'search=' + searchid;
	if (searchid != '') {
		$.ajax({
			type : "POST",
			url : "./ajax/fetchMeasures.php",
			data : dataString,
			cache : false,
			success : function(html) {
				$(smt).closest("tr").find("#mat").html(html).show();
			}
		});
	}
	return false;
}

$(document).ready(
		function() {

			$(".add").click(
					function() {
						$(".row").eq(-1).clone(true).appendTo(
								".productsContainer")
								.find("input[type='text']").val("");
						$(".add").eq(-2).off("click");
						$(".add").eq(-2).bind("click", function() {
							$(this).closest(".row").remove();
						})
						$(".add").eq(-2).val("-");
						$(".add").eq(-2).attr("name", "del");
						$(".add").eq(-2).removeClass("add").addClass("del");
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
			
			$("#searchid").change(function() {
				fetchMeasures(this);
			});

			$('#result').click(function(e) {
				var txt = $(e.target).text().replace('\t', '');
				if ($(e.target).is("strong")) {
					var txt = $(e.target).parent().text().replace('\t', '');
				}
				$(this).prev().val(txt);
			});

			$(document).on("click", function(e) {
				var $clicked = $(e.target);
				$("#result").each(function() {
					$(this).fadeOut();
				});
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

			//
			// $(".portionIn").change(function() {
			// var portion = $(this).val();
			// var id = $('#recpId').val();
			// var defaultP = $('#recpP').val();
			// if (portion != '') {
			// $.ajax({
			// type : "POST",
			// url : "./ajax/checkIfEnoughProducts.php",
			// data : ({portion: portion, id: id, defaultP: defaultP}),
			// cache : false,
			// success : function(data) {
			// $("#testt").html(data);
			// }
			// });
			// }
			// return false;
			// });

		});
