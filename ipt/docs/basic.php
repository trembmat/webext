



<h1>Cr�ation d'une application de base</h1>

<p>
Dans cet exemple, nous allons cr�er une application dont l'ensemble du code source
sera contenu dans un seul et m�me dossier. Cette fa�on de faire nous permettra de facilement
copier notre application tout en nous laissant la possibilit� de mettre � jour I+IPT 
si cela est n�cessaire un jour.
</p>


<div style="float:left;padding:10px;width:450px;margin:10px;">
<h2>�tape par �tape</h2>
<ul  style="float:left;width:450px;margin:10px;">

  <li>
    Cr�er votre dossier application<br>
    Ex: /home/user/mywebsite.com/myapp/<br><br>
  </li>
  
  <li>
    Installer I+IPT<br>
    Ex: /home/user/mywebsite.com/myapp/ipt/<br><br>
  </li>
  
  <li>
    Cr�er un dossier pour stocker vos fichiers de configuration<br>
    Ex: /home/user/mywebsite.com/myapp/config/<br><br>
    
    
    <ul>
      <li>
        Cr�er un fichier .htaccess ou index.php pour prot�ger votre r�pertoire<br><br>
      </li>
      <li>
        Cr�er votre fichier comprenant vos informations de configuration<br>
        Ex: config.php<br><br>
      </li>
    </ul>
    
    
  </li>
  
  <li>
    Cr�er un dossier pour stocker vos mod�les de page web (HTML)<br>
    Ex: /home/user/mywebsite.com/myapp/html/<br><br>
  </li>
  
  <li>
    Cr�er un dossier pour stocker vos fichiers javascript (.js)<br>
    Ex: /home/user/mywebsite.com/myapp/js/<br><br>
  </li>
  
    
  <li>
    Cr�er un dossier pour stocker les classes et fonctions de votre application<br>
    Ex: /home/user/mywebsite.com/myapp/include/<br><br>
  </li> 
   
  <li>
    Cr�er votre application<br>
    Ex: /home/user/mywebsite.com/myapp/index.php<br><br>
  </li>   
</ul>

</div>





<div style="float:left;width:250px;padding:10px;margin:10px;background-color:#d0d0d0;">

<h2>Structure</h2>
Ex: /home/user/mywebsite.com/myapp/<br><br>

<ul>
  <li>/index.php</li>
  <li>/.htaccess</li>
  <li>/ipt</li>
  <li>/config
      <ul>
        <li>/index.php</li>
        <li>/config.php</li>
      </ul>
  </li>
  <li>/html
      <ul>
        <li>/index.php</li>
        <li>/frame
            <ul>
              <li>/index.php</li>
              <li>/header.html</li>
              <li>/menu.html</li>
              <li>/footer.html</li>
            </ul>        
        
        </li>
        <li>/forms
            <ul>
              <li>/index.php</li>
              <li>/login.html</li>
              <li>/form1.html</li>
            </ul>           
        </li>
        <li>/widgets
            <ul>
              <li>/index.php</li>
              <li>/slider.html</li>
            </ul>        
        </li>
      </ul>
  </li>  


  <li>/include
      <ul>
        <li>/dbstructure.php</li>
        <li>/index.php</li>
        <li>/functions.php</li>
      </ul>
  </li> 
  <li>/js
      <ul>
        <li>/index.php</li>
      </ul>
  </li> 
  
</ul>

</div>
