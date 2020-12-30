<!DOCTYPE html>
<html>
<head>
	<title>Create Asset</title>
</head>
<body>
<form action="insert.php" method="POST">
	<table >
		<tr>
			<td>
				AssetID
			</td>
			<td>
				<input type="text" placeholder="id" name="assetID" required>
			</td>
		</tr>
		<tr>
			<td>
				BI name
			</td>
			<td>
				<input type="text" placeholder="BI name" name="nameBI" required>
			</td>
		</tr>
		<tr>
			<td>
				BM name
			</td>
			<td>
				<input type="text" placeholder="BM name" name="nameBM" required>
			</td>
		</tr>
		<tr>
			<td>
				Description 
			</td>
			<td>
				<input type="text" placeholder="Description" name="description" required >
			</td>
		</tr>
		<tr>
			<td>
				Cost  
			</td>
			<td>
				<input type="text" placeholder="id" name="cost" required >
			</td>
		</tr>

		<tr>
			<td>
				Amount 
			</td>
			<td>
				<input type="text" placeholder="id" name="amount" required >
			</td>
		</tr>
		<tr>
			<td>
				Category
			</td>
			<td>
				<input type="radio" name="category" value="1" required>ICT
				<input type="radio" name="category" value="2" required>Non-ICT
			</td>
		</tr>

		<tr>
			<td>
				Condition
			</td>
			<td>
				<select name="asset_condition" required >
					<option value="1">New</option>
					<option value="2">Secondhand</option>
				</select>
			</td>
		</tr>

		<tr>
			<td>
				Date purchased
			</td>
			<td>
				<input type="date"  name="date_purchased" required >
			</td>
		</tr>

		<tr>
			<td>
				<input type="submit" value="Submit" name="" required>
			</td>
		</tr>

	</table>
</form>
</body>
</html>
