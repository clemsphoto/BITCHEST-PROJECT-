

<!--   Menu de l'administrateur affiché -->


<h2>ADMINISTRATEUR</h2>
<ul class="nav nav-sidebar">
    <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Vue générale <span class="sr-only">(current)</span></a></li>
    <li class="{{ Request::is('account') ? 'active' : '' }}"><a href="/account">Gérer mes données personnelles</a></li>
    <li class="{{ Request::is('clients') ? 'active' : '' }}"><a href="/clients">Gérer les clients</a></li>
    <li class="{{ Request::is('listCrypto') ? 'active' : '' }}"><a href="/listCrypto">Afficher les cryptos monnaies</a></li>
    </ul>

</div>