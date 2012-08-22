                                <div class="boxy-title">
                                    <h3>Administrar Temas</h3>
                                </div>
                                <div id="res" class="boxy-content">
                                {if $tsSave}
                                    <div style="display: block;" class="mensajes ok">Tus cambios han sido guardados.</div>
                                {/if}
                                    {if $tsAct == ''}
                                	<table cellpadding="0" cellspacing="0" border="0" width="500" align="center" class="admin_table">
                                    	<thead>
                                            <th>Vista previa</th>
                                            <th>Nombre</th>
                                            <th>Opciones</th>
                                        </thead>
                                        <tbody>
                                           <? 
                                            foreach ($tsTemas as $tema)
                                            {
                                            ?>
                                        	<tr>
                                        		<td width="150">
                                                            <img src="<? echo $tema['t_url']; ?>/screenshot.png" width="150" height="100" />
                                                        </td>
                                                <td><b>
                                                        <u><? echo $tema['t_name']; ?></u>
                                                    </b>
                                                </td>
                                                <td class="admin_actions">
                                                	<a href="?act=editar&tid=<? echo $tema['tid']; ?>">
                                                            <img src="<? echo $tsConfig['url']; ?>/themes/default/images/icons/editar.png" title="Editar este tema"/></a>
                                                <?
                                                if ($tsConfig['tema_id'] == $tema['tid'])
                                                {        
                                                ?>         
                                                	<a onclick="return false;">
                                                            <img src="<? echo $tsConfig['url']; ?>/themes/default/images/icons/yes.png" title="Este tema est&aacute; en uso" /></a>
                                                <?
                                                }
                                                else
                                                {    
                                                ?>   
                                                	<a href="?act=usar&tid=<? echo $tema['tid']; ?>&tt=<? echo $tema['t_name']; ?>">
                                                            <img src="<? echo $tsConfig['url']; ?>/themes/default/images/icons/theme.png" title="Usar este tema" /></a>
                                                        <?                                                    
                                                        if ($tema['tid'] != 1)
                                                        {
                                                        ?>
                                                        <a href="?act=borrar&tid=<? echo $tema['tid']; ?>&tt=<? echo $tema['t_name']; ?>">
                                                            <img src="<? echo $tsConfig['url']; ?>/themes/default/images/icons/close.png" title="Borrar este tema" /></a>
                                                        <?
                                                        }
                                                        
                                                 }
                                                ?>
                                                </td>
                                                </tr>
                                            <?                                            
                                            } // end foreach themes
                                            ?>
                                        </tbody>
                                    </table>
                                    <hr />
                                    <input type="button"  onclick="location.href = '<? echo $tsConfig[url]; ?>/admin/temas?act=nuevo'"value="Instalar nuevo tema" class="mBtn btnOk" style="margin-left:280px;">
                                    {elseif $tsAct == 'editar'}
                                    <form action="" method="post" id="admin_form" autocomplete="off">
                                    	<label for="ai_name">Nombre del tema:</label>
                                        <input type="text" id="ai_name" name="name" value="<? echo $tsTema['t_name']; ?>" size="30" disabled="disabled"/> 
                                        Por copyright no se pude modificar.<br class="spacer" />
                                        <label for="ai_url">Url completa del tema:</i></label>
                                        <input type="text" id="ai_url" name="url" value="<? echo $tsTema['t_url']; ?>" size="30" />
                                        <br class="spacer" />
                                    	<label for="ai_path">Nombre de la carpeta donde esta el tema:<br /><i><? echo $tsConfig['url']; ?>/themes/</i></label>
                                        <input type="text" id="ai_path" name="path" value="<? echo $tsTema['t_path']; ?>" size="30" />
                                        <hr />
                                        <label>&nbsp;</label>
                                        <input type="submit" value="Guardar tema" name="save" class="mBtn btnOk">
                                    </form>
                                    {elseif $tsAct == 'usar' || $tsAct == 'borrar'}
                                    <form action="" method="post" id="admin_form" autocomplete="off">
                                    	<h3 align="center">{$tt}</h3>
                                    	<label>&nbsp;</label>
                                        <input type="submit" name="confirm" value="<? if ($tsAct == 'usar') { echo 'Confirmar el cambio de'; } else { echo 'Continuar borrando este'; } ?> tema &raquo;" class="mBtn btnOk">
                                        {if $tsAct == 'borrar'}
                                        <p align="center">Te recordamos que debes borrar la carpeta del theme manualmente en el servidor.</p>
                                        {/if}
                                    </form>
                                    {elseif $tsAct == 'nuevo'}
                                    {if $tsError}
                                        <div style="display: block;" class="mensajes error"><? echo $tsError; ?></div>
                                    {/if}
                                    <form action="" method="post" id="admin_form" autocomplete="off">
                                    	<label for="ai_path">Nombre de la carpeta donde esta el tema a instalar:<br />
                                            <i><? echo $tsConfig['url']; ?>/themes/</i></label>
                                        <input type="text" id="ai_path" name="path" size="30" />
                                        <hr />
                                        <label>&nbsp;</label>
                                        <input type="submit" value="Instalar tema" class="mBtn btnOk">
                                    </form>
                                    {/if}
                                </div>