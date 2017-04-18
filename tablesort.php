<html>
<head>
<title>Table Sort </title>
<script src="sorttable.js"></script>

<script type="text/javascript">
$(document).ready(function() { 
    // call the tablesorter plugin 
    $("table").tablesorter({ 
        // sort on the first column and third column, order asc 
        sortList: [[0,0],[2,0]] 
    }); 
}); 
</script>

<style>
/* Sortable tables */
table.sortable thead {
    background-color:#eee;
    color:#666666;
    font-weight: bold;
    cursor: default;
}
</style>
</head>

<body>
<table class="sortable">            
    <thead> 
        <tr> 
            <th>first name</th> 
            <th>last name</th> 
            <th>age</th> 
            <th>total</th> 
            <th>discount</th> 
            <th>date</th> 
        </tr> 
    </thead> 
    <tbody> 
        <tr> 
            <td>peter</td> 
            <td>parker</td> 
            <td>28</td> 
            <td>$9.99</td> 
            <td>20%</td> 
            <td>jul 6, 2006 8:14 am</td> 
        </tr> 
        <tr> 
            <td>john</td> 
            <td>hood</td> 
            <td>33</td> 
            <td>$19.99</td> 
            <td>25%</td> 
            <td>dec 10, 2002 5:14 am</td> 
        </tr> 
        <tr> 
            <td>clark</td> 
            <td>kent</td> 
            <td>18</td> 
            <td>$15.89</td> 
            <td>44%</td> 
            <td>jan 12, 2003 11:14 am</td> 
        </tr> 
        <tr> 
            <td>bruce</td> 
            <td>almighty</td> 
            <td>45</td> 
            <td>$153.19</td> 
            <td>44%</td> 
            <td>jan 18, 2001 9:12 am</td> 
        </tr> 
        <tr> 
            <td>bruce</td> 
            <td>evans</td> 
            <td>22</td> 
            <td>$13.19</td> 
            <td>11%</td> 
            <td>jan 18, 2007 9:12 am</td> 
        </tr> 
    </tbody> 
</table>

</body>
</html>