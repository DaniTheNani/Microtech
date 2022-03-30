$sql21 = "SELECT components.name FROM ((components 
INNER JOIN comp_prop ON components.id = comp_prop.com_id)
INNER JOIN propeties ON properties.id = comp_prop.prop_id) WHERE cat_id = 1";