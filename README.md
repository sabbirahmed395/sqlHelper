# sqlHelper
This helper class returns sql string only, we need to specify the table name and data array to get sql string

<h3>To Insert a row into table</h3>

use <pre>sqlHelper::insert($tableName, $dataArray)</pre> function

E.g. <pre>sqlHelper::insert('myTable', ['column1'=>'value1', 'column2'=>'value2', 'column3'=>'value3']);</pre>

this will return <pre>"INSERT INTO `myTable` ('column1', 'column2', 'column3') VALUES ('value1', 'value2', 'value3')"</pre>


<h3>To select a row form table</h3>
use <pre>sqlHelper::select($tableName, $columnArrayToBeFetched);</pre>
use <pre>sqlHelper::select($tableName, $columnArrayToBeFetched, $where);</pre>
use <pre>sqlHelper::select($tableName, $columnArrayToBeFetched, $limit);</pre>
use <pre>sqlHelper::select($tableName, $columnArrayToBeFetched, $where, $limit);</pre>

<code>$where</code> and <code>$limit</code> is optional. By default <code>$limit</code> is 1 <br />
To fetch a range of row <code>$limit = "$start, $amount"</code>
And to fetch all row <code>$limit = '*'</code>

E.g. <pre>sqlHelper::select('myTable', ['column1', 'column2', 'column3']);</pre>
This will return <pre>"SELECT `column1`, `column2`, `column3` FROM `myTable` LIMIT 1"</pre>

E.g. <pre>sqlHelper::select('myTable', ['column1'], ['column2'=>'value2', 'column3'=>'value3']);</pre>
This will return <pre>"SELECT `column1` FROM `myTable` WHERE `column2`='value2' AND `column3`='value3' LIMIT 1"</pre>

E.g. <pre>sqlHelper::select('myTable', ['column1'], 2);</pre>
This will return <pre>"SELECT `column1` FROM `myTable` LIMIT 2"</pre>

E.g. <pre>sqlHelper::select('myTable', ['column1'], "2, 10");</pre>
This will return <pre>"SELECT `column1` FROM `myTable` LIMIT 2, 10"</pre>

E.g. <pre>sqlHelper::select('myTable', ['column1'], ['column2'=>'value2', 'column3'=>'value3'], "10, 5");</pre>
This will return <pre>"SELECT `column1` FROM `myTable` WHERE `column2`='value2' AND `column3`='value3' LIMIT 10, 5"</pre>

<h3>To Update Row</h3>
Use <code>sqlHelper::update($table, $data, $where);</code>

E.g. <pre>sqlHelper::update('myTable', ['column2'=>'value2', 'column3'=>'value3'], ['column1'=>'value1']);</pre>
This will return <pre>"UPDATE `myTable` SET `column2`='value2', `column3`='value3' WHERE `column1`='value1'"</pre>

<h3>To Delete Row</h3>
Use <code>sqlHelper::delete($table, $where, $limit);</code>
<code>$limit</code> is optional here. Default <code>$limit</code> is 1

E.g. <pre>sqlHelper::delete('myTable', ['column1'=>'value1']);</pre>
This will return <pre>"DELETE FROM `myTable` WHERE `column1`='value1' LIMIT 1"</pre>

