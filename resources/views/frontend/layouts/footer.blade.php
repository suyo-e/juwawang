<?php //dd(Active::checkUriPattern('home')); ?>
<div class="footerNav">
    <ul>
        <li>
            <a href="/home">
                <img src="/image/{{ Active::checkUriPattern('home')||Active::checkUriPattern('/')?'foter-nav-h': 'foter-nav-hui' }}.png" alt="" data-active="foter-nav-h"/>
                <p>首页</p>
            </a>
        </li>
        <li>
            <a href="/class">
                <img class="foter-nav-f" src="/image/{{ Active::checkUriPattern('class')?'fanleilan': 'foter-nav-f' }}.png" data-active="fanleilan" alt=""/>
                <p>分类信息</p>
            </a>
        </li>
        <li>
            <a href="/information">
                <img class="foter-nav-z" src="/image/{{ Active::checkUriPattern('information')?'foter-nav-z-active': 'foter-nav-z' }}.png" alt=""/>
                <p>资讯</p>
            </a>
        </li>
        <li>
            <a href="/user">
                <img class="foter-nav-z" src="/image/{{ Active::checkUriPattern('user')?'renlan': 'foter-nav-r' }}.png" data-active="fanleilan" alt=""/>
                <p>我的</p>
            </a>
        </li>
    </ul>
</div>
