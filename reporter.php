<?php
include('Database.php');

?>

<html>
    <head>
        <h1>Content security policy reporter</h1>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages':['table']});
            google.charts.setOnLoadCallback(drawTable);

            function drawTable() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'time');
                data.addColumn('string', 'ip');
                data.addColumn('string', 'referrer');
                data.addColumn('string', 'user_agent');
                data.addColumn('string', 'report_blocked_uri');
                data.addColumn('string', 'report_disposition');
                data.addColumn('string', 'report_document_uri');
                data.addColumn('string', 'report_effective_directive');
                data.addColumn('string', 'report_original_policy');
                data.addColumn('string', 'report_referrer');
                data.addColumn('string', 'report_script_sample');
                data.addColumn('string', 'report_status_code');
                data.addColumn('string', 'report_violated_directive');
                data.addRows(<?php echo json_encode(Database::getAll(), JSON_PRETTY_PRINT); ?>);

                var table = new google.visualization.Table(document.getElementById('table_div'));

                table.draw(data, {page: 'enabled',pageSize: 10, showRowNumber: true, width: '90%', height: '100%'});
            }
        </script>
        <!--<form action="#">-->
<!--             From: <input type="date" name="from">-->
<!--             TO: <input type="date" name="to">-->
<!--  <input type="submit">-->
<!--</form>-->


    </head>

<body>
<!--Div that will hold the pie chart-->
<div id="table_div"></div>
</body>
</html>
