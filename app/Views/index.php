<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bootstrap demo</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>

<body>
	<div class="container py-3 px-3">

		<form action="" method="post">
			<div id="reportrange"
				style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
				<i class="fa fa-calendar"></i>&nbsp;
				<span></span> <i class="fa fa-caret-down"></i>
			</div>
		</form>
		<div class="mt-3">
			<table>
				<thead>
					<tr>
						<td>Id</td>
						<td>Name</td>
						<td>Created At</td>
					</tr>
				</thead>
				<tbody id="iniIsi">

				</tbody>
			</table>
		</div>

	</div>

	<script type="text/javascript">
		$(function () {
			function cb(start, end, shouldFetch = true) {
				$('#reportrange span').html(`${start.format('D MMM YYYY')} - ${end.format('D MMM YYYY')}`);

				if (shouldFetch) {
					handleDateFilter(start.format("YYYY-MM-DD"), end.format("YYYY-MM-DD"))
				}
			}

			var start = moment().subtract(7, 'days')
			var end = moment()

			$('#reportrange').daterangepicker({
				startDate: start,
				endDate: end,
				ranges: {
					'Today': [moment(), moment()],
					'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					'Last 7 Days': [moment().subtract(6, 'days'), moment()],
					'Last 30 Days': [moment().subtract(29, 'days'), moment()],
					'This Month': [moment().startOf('month'), moment().endOf('month')],
					'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				},
				opens: "bottom"
			}, cb);

			cb(start, end)
		});

		const handleDateFilter = (start, end) => {

			fetch(`/?start=${start}&end=${end}`, {
				headers: {
					"Content-Type": "application/json",
					"X-Requested-With": "XMLHttpRequest"
				}
			})
				.then(r => r.json())
				.then(response => {
					const { data } = response


					document.getElementById('iniIsi').innerHTML = /* html */ data.map((dummy) => {
						console.log(dummy)

						return /* html */ `
							<tr>
								<td>
									${dummy.id}
								</td>
								<td>
									${dummy.name}
								</td>
								<td>
									${dummy.created_at}
								</td>
							</tr>
						`
					}).join("")

				})
		}
	</script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
		crossorigin="anonymous"></script>
</body>

</html>