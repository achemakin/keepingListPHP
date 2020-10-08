                </td>
            </tr>
        </table>
    
        <div class="clearfix">
            <?php showMenu($mainMenu, SORT_DESC, 'main-menu bottom', 'title');?>
        </div>
        
        <div class="footer">&copy;&nbsp;<nobr>2018</nobr> Project.</div>
    </body>
</html>

<?php
mysqli_close(getConnection());