function fctDisplayBouton(v_TrueFalse)
{
	 document.getElementById("divConteneurBouton").style.display=v_TrueFalse;
}

var i=1;

	function getImageSource(v_ImageActuel)
	{
		switch(v_ImageActuel)
		{
			case 2:
				document.getElementById("img3").src = "londres.jpg";
				break;
			case 3:
				document.getElementById("img3").src = "new_york.jpg";
				break;
			case 1:
				document.getElementById("img3").src = "paris.jpg";
				break;
		}
	}
	
	var ImageActuelle=0;
	
	function affiche()
	{
		ImageActuelle =  i;
			
		getImageSource(ImageActuelle);
		
		if (i==3) 
			i = 0;
			
		
	}
	
	function change() {
		i++;
			
		affiche();
	}
	
	setInterval(change, 10000);
	
	

	function ChangeImage(v_Sens)
	{
		if (v_Sens == "avant")
			{
				i = i - 1;
				if (i==0)
					i=3;
			}
		if (v_Sens == "apres")
			{
				i = i + 1;
				if (i>3)
					i = 1;
			}
		getImageSource(i);
	}
	