.ONESHELL:

all:
	dir

publish:
	xcopy /Y /E $(DIR) C:\xampp\htdocs\$(DIR)\\ &
	>nul find "<li><h3><a href='$(DIR)/'>$(DIR)</a></h3></li>" C:\xampp\htdocs\index.php && (echo HyperLink Exists) || (echo ^<li^>^<h3^>^<a href='$(DIR)/'^>$(DIR)^</a^>^</h3^>^</li^> >> C:\xampp\htdocs\index.php)


# run as: make publish DIR="folderName"
