                                <div class="boxy-title">
								<h3>Administrar Usuarios</h3>
								</div>
								<div id="res" class="boxy-content" style="position:relative">
                                                               <?     
								if (!$tsAct)
                                                                {
								if (!$tsMembers['data'])
                                                                {
                                                                ?>
								<div class="phpostAlfa">No hay usuarios registrados.</div>
                                                                <?
                                                                }
								else
                                                                {    
                                                                ?>
								<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%" align="center">
									<thead>
										<th>Rango</th>
										<th>Usuario</th>
										<th><a class="qtip" title="Ordenar por email ascendente" href="<? echo $tsConfig['url']; ?>/admin/users?o=c&m=a"><</a> Email <a class="qtip" title="Ordenar por email descendente" href="<? echo $tsConfig['url']; ?>/admin/users?o=c&m=d">></a></th>
										<th><a class="qtip" title="Ordenar por &uacute;ltima vez activo ascendente" href="<? echo $tsConfig['url']; ?>/admin/users?o=u&m=a"><</a> &Uacute;ltima actividad <a class="qtip" title="Ordenar por &uacute;ltima vez activo desccendente" href="<? echo $tsConfig['url']; ?>/admin/users?o=u&m=d">></a></th>
										<th>Registro</th>
										<th><a class="qtip" title="Ordenar por IP ascendente" href="<? echo $tsConfig['url']; ?>/admin/users?o=i&m=a"><</a> IP <a class="qtip" title="Ordenar por IP descendente" href="<? echo $tsConfig['url']; ?>/admin/users?o=i&m=d">></a> </th>
										<th>Estado</th>
										<th>Acciones</th>
									</thead>
									<tbody>
                                                                            <? 
										foreach ($tsMembers['data'] as $m)
                                                                                {
                                                                                ?>    
										<tr>
											<td><img src="<? echo $tsConfig['default']; ?>/images/icons/ran/<? echo $m['r_image']; ?>" /></td>
											<td align="left">
                                                                                            <a href="<? echo $tsConfig['url']; ?>/perfil/<? echo $m['user_name']; ?>" class="hovercard" uid="<? echo $m['user_id']; ?>" style="color:#<? echo $m['r_color']; ?>;"><? echo $m['user_name']; ?></a></td>
											<td><? echo $m['user_email']; ?></td>
											<td><? if ($m['user_lastactive'] == 0) echo 'Nunca'; else echo modifier_hace($m['user_lastactive']);?></td>
                                                                                        <td><? echo modifier_hace($m['user_registro']);?>date_format:"%d/%m/%Y"}</td>
											<td><a href="<? echo $tsConfig['url']; ?>/moderacion/buscador/1/1/<? echo $m['user_last_ip']; ?>" class="geoip" target="_blank"><? echo $m['user_last_ip']; ?></a></td>
											<td id="status_user_<? echo $m['user_id']; ?>">
                                                                                            <?
                                                                                            if ($m['user_baneado'] == 1)
                                                                                            {
                                                                                            ?>
                                                                                                <font color="red">Suspendido</font>
                                                                                            <?    
                                                                                            }
                                                                                            elseif ($m['user_activo'] == 0)
                                                                                            {
                                                                                            ?>
                                                                                                <font color="purple">Inactivo</font>
                                                                                            <?
                                                                                            }
                                                                                            else
                                                                                            {
                                                                                            ?>  
                                                                                                
                                                                                                <font color="green">Activo</font>
                                                                                            <?                                                                                              
                                                                                            }
                                                                                            ?>
                                                                                        </td>
											<td class="admin_actions">
												<a href="<? echo $tsConfig['url']; ?>/admin/users?act=show&uid=<? echo $m['user_id']; ?>">
                                                                                                    <img src="<? echo $tsConfig['default']; ?>/images/icons/editar.png" title="Editar Usuario" /></a>												
												<a onclick="admin.users.setInActive(<? echo $m['user_id']; ?>); return false;">
                                                                                                    <img src="<? echo $tsConfig['default']; ?>/images/reactivar.png" title="Activar/Desactivar Usuario" /></a>
                                                                                                <a href="#" onclick="mod.users.action(<? echo $m['user_id']; ?>, 'aviso', false); return false;">
                                                                                                    <img src="<? echo $tsConfig['default']; ?>/images/icons/warning.png" title="Enviar Alerta" /></a>
												<a href="#" onclick="mod.<? if ($m['user_baneado'] == 1){ ?>reboot(<? echo $m['user_id'];?>, 'users', 'unban', false)<? }else{?> users.action(<? echo $m['user_id'];?>, 'ban', false)<? } ?>; return false;">
                                                                                                    <img src="<? echo $tsConfig['default']; ?>/images/icons/power_<? if ($m['user_baneado'] == 1) echo 'on'; else echo 'off'; ?>.png" title="<? if ($m['user_baneado'] == 1) echo 'Reactivar'; else echo 'Suspender'; ?> Usuario" />
                                                                                                </a>
											</td>
										</tr>
										<?
                                                                                }
                                                                                ?>
									</tbody>
									<tfoot>
										<td colspan="8">P&aacute;ginas: <? echo $tsMembers['pages']; ?></td>
									</tfoot>
								</table>
                                                                <?
                                                                }
								}
								elseif ($tsAct == 'show')
                                                                {
                                                                ?>    
								<div class="admin_header">
								<h1>Administrar: <strong><? echo $tsUsername; ?></strong></h1>
								<div class="floatR"><strong>Seleccionar:</strong> 
									<select onchange="location.href='<? echo $tsConfig[url]; ?>/admin/users?act=show&uid=<? echo $tsUserID; ?>&t=' + this.value;">
										<option value="1"<? if ($tsType == 1) echo 'selected="true"'; ?>>Vista general</option>
										<option value="5"<? if ($tsType == 5) echo 'selected="true"'; ?>>Preferencias</option>
                                                                                <option value="6"<? if ($tsType == 6) echo 'selected="true"'; ?>>Borrar Contenido</option>
										<option value="7"<? if ($tsType == 7) echo 'selected="true"'; ?>>Rango</option>
										<option value="8"<? if ($tsType == 8) echo 'selected="true"'; ?>>Firma</option>
									</select>
								</div>
								<div class="clearBoth"></div>
								</div>
                                                                <?
								if ($tsSave)
                                                                {
                                                                ?>
                                                                    <div class="mensajes ok">Tus cambios han sido guardados.</div>
                                                                <?    
                                                                }
								if ($tsError)
                                                                {    
                                                                ?>    
                                                                    <div class="mensajes error"><? echo $tsError; ?></div>
                                                                <?    
                                                                }
                                                                ?>
								<form action="" method="post">
									<fieldset>
                                                                        <?    
									if (!$tsType || $tsType == 1)
                                                                        {   
                                                                        ?>    
										<legend>Vista general</legend>
										<dl>
											<dt><label for="user">Nombre de Usuario:</label></dt>
											<dd>
                                                                                            <input type="text" name="nick" id="user" value="<? echo $tsUserD['user_name']; ?>" class="qtip" title="El nick s&oacute;lo se cambiar&aacute; si escribe una nueva contrase&ntilde;a" /></dd>
										</dl>
										<dl>
											<dt><label for="user">Rango:</label></dt>
											<dd>
                                                                                            <strong style="color:#<? echo $tsUserD['r_color']; ?>"><? echo $tsUserD['r_name']; ?></strong>
                                                                                        </dd>
										</dl>
										<dl>
											<dt><label for="registro">Registrado:</label></dt>
											<dd><strong><? echo ($tsUserD['user_registro']);?>|date_format:"%d/%m/%Y a las %H:%M"</strong></dd>
										</dl>
										<dl>
											<dt><label>&Uacute;ltima vez activo:</label></dt>
                                                                                        <dd><strong><? echo modifier_hace($tsUserD['user_lastactive']);?></strong></dd>
										</dl>
										<dl>
											<dt><label>Puntos:</label></dt>
											<dd><input type="text" name="points" id="points" value="<? echo $tsUserD['user_puntos']; ?>" style="width:10%" /></dd>
										</dl>
										<dl>
											<dt><label>Puntos para dar:</label></dt>
											<dd><input type="text" name="pointsxdar" id="pointsxdar" value="<? echo $tsUserD['user_puntosxdar']; ?>" style="width:10%" /></dd>
										</dl>
										<dl>
											<dt><label>Cambios de nick disponibles:</label></dt>
											<dd><input type="text" name="changenicks" id="changenicks" value="<? echo $tsUserD['user_name_changes']; ?>" style="width:10%" /></dd>
										</dl>
										<hr />
										<dl>
											<dt><label for="email">E-mail:</label></dt>
											<dd><input type="text" name="email" id="email" value="<? echo $tsUserD['user_email']; ?>" /></dd>
										</dl>
										<dl>
											<dt><label for="pwd">Nueva contrase&ntilde;a:</label><br /><span>Debe tener entre 5 y 35 caracteres.</span></dt>
											<dd><input type="password" name="pwd" id="pwd" onkeypress="if($('#cpwd').val() != '') $('#sendata').fadeIn();"/></dd>
										</dl>
										<dl>
											<dt><label for="cpwd">Confirmar contrase&ntilde;a:</label><br /><span>Necesita confirmar su contrase&ntilde;a s&oacute;lo si la ha cambiado arriba.</span></dt>
											<dd><input type="password" name="cpwd" id="cpwd" onkeypress="if($('#pwd').val() != '') $('#sendata').fadeIn();"/></dd>
										</dl>
										 <dl id="sendata" style="display:none;">
											<dt><label for="sendata">Informar al usuario</label><br /><span>Marque esta casilla si quiere enviar un e-mail al usuario con los nuevos datos</span></dt>
											<dd><input type="checkbox" name="sendata"/></dd>
										</dl>
                                                                        <?
                                                                        }
									elseif ($tsType == 5)
                                                                        {
                                                                        ?>
									<legend>Modificar privacidad del usuario</legend>
										<h2 class="active">&iquest;Qui&eacute;n puede...</h2>
									<div class="field">
										<dl>
											<dt><label>ver su muro?</label></dt>
											<dd>
												<select name="muro" style="width:270px;">
                                                                                                <?    
												foreach ($tsPrivacidad as $i=>$p)
                                                                                                {
                                                                                                ?>    
												<option value="<? echo $i; ?>"<? if ($tsPerfil['p_configs']['m'] == $i) echo 'selected="true"'; ?>><? echo $p; ?></option>
                                                                                                <?
												}
                                                                                                ?>
												</select>
											</dd>
										</dl>                    				
									</div>
									<? echo $tsPerfil['p_configs']['muro']; ?>
									<div class="field">
										<dl>
										<dt><label>firmar su muro?</label></dt>
											<dd>
												<select name="muro_firm" style="width:270px;">
                                                                                                <?    
												foreach ($tsPrivacidad as $i=>$p)
                                                                                                {                                                                                                
												if ($i != 6)
                                                                                                {
                                                                                                ?>
                                                                                                    <option value="<? echo $i; ?>"<? if ($tsPerfil['p_configs']['mf'] == $i) echo 'selected'; ?>><? echo $p; ?></option>
                                                                                                <?
                                                                                                }
												}
                                                                                                ?>
												</select>
											</dd>
										</dl>
									</div>
									<div class="field">
										<dl>
										<dt><label>ver visitantes recientes?</label></dt>
											<dd>
												<select name="last_hits" style="width:270px;">
                                                                                                <?    
												foreach ($tsPrivacidad as $i=>$p)
                                                                                                {    
												if ($i != 1 && $i != 2)
                                                                                                {
                                                                                                ?>    
                                                                                                    <option value="<? echo $i; ?>"<? if ($tsPerfil['p_configs']['hits'] == $i) echo 'selected'; ?>><? echo $p; ?></option>
                                                                                                <?    
                                                                                                }
												}
                                                                                                ?>                                                                                                
												</select>
											</dd>
										</dl>
									</div>
									<div class="field">
											<dl>
												<dt><label>enviarles mensajes privados?</label><br />
                                                                                                <span>Esta opci&oacute;n no se aplica a moderadores y administradores.</span>
                                                                                                </dt>
												<dd>
													<select name="rec_mps" style="width:270px;">
														<?
                                                                                                                foreach ($tsPrivacidad as $i=>$p)
                                                                                                                {    
														if ($i != 6)
                                                                                                                {
                                                                                                                ?>   
                                                                                                                    <option value="<? echo $i; ?>"<? if ($tsPerfil['p_configs']['rmp'] == $i) echo 'selected'; ?>><? echo $p; ?></option>
                                                                                                                <?    
                                                                                                                }
														}
                                                                                                                ?>
														<option value="8"<? if ($tsPerfil['p_configs']['rmp'] == 8) echo 'selected'; ?>>Deshabilitar mensajer&iacute;a (opci&oacute;n administrativa)</option>
													</select>
												</dd>
											</dl>
									</div>
                                        <?
                                        }
                                        elseif ($tsType == 6)
                                        {
                                        ?>    
					<legend>Eliminaci&oacute;n de contenidos</legend>
					<input type="checkbox" id="bocuenta" name="bocuenta" onclick="$('#ext').slideToggle();"/>
                                        <label style="font-weight:bold;" for="bocuenta">Cuenta Completa</label>
                                        <label for="bocuenta"> &nbsp; Se eliminar&aacute; la cuenta y todo el contenido relacionado a <? echo $tsUsername; ?>.</label>
					<div id="ext">
                                        <br /><hr/>
                                        <input type="checkbox" id="boposts" name="boposts"/>
                                        <label style="font-weight:bold;" for="boposts">Posts</label>
                                        <label for="boposts"> &nbsp; Se eliminar&aacute;n todos sus posts y sus comentarios.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bofotos" name="bofotos"/>
                                        <label style="font-weight:bold;" for="bofotos">Fotos</label>
                                        <label for="bofotos"> &nbsp; Se eliminar&aacute;n todas sus fotos publicadas y sus comentarios.</label>
										<br /><hr/>
                                        <input type="checkbox" id="boestados" name="boestados"/>
                                        <label style="font-weight:bold;" for="boestados">Estados</label>
                                        <label for="boestados"> &nbsp; Se eliminar&aacute;n todas sus publicaciones de muros</label>
										<br /><hr/>
                                        <input type="checkbox" id="bocomposts" name="bocomposts"/>
                                        <label style="font-weight:bold;" for="bocomposts">Comentarios de Posts</label>
                                        <label for="bocomposts"> &nbsp; Se eliminar&aacute;n todos sus comentarios en posts.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bocomfotos" name="bocomfotos"/>
                                        <label style="font-weight:bold;" for="bocomfotos">Comentarios de Fotos</label>
                                        <label for="bocomfotos"> &nbsp; Se eliminar&aacute;n todos sus comentarios en fotos.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bocomestados" name="bocomestados"/>
                                        <label style="font-weight:bold;" for="bocomestados">Comentarios en Estados</label>
                                        <label for="bocomestados"> &nbsp; Se eliminar&aacute;n todos sus comentarios en estados</label>
										<br /><hr/>
                                        <input type="checkbox" id="bolike" name="bolike"/>
                                        <label style="font-weight:bold;" for="bolike">Like</label>
                                        <label for="bolike"> &nbsp; Se eliminar&aacute;n sus likes en estados y comentarios en estados</label>
										<br /><hr/>
                                        <input type="checkbox" id="boseguidores" name="boseguidores"/>
                                        <label style="font-weight:bold;" for="boseguidores">Seguidores</label>
                                        <label for="boseguidores"> &nbsp; Se eliminar&aacute; la lista de todos sus seguidores.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bosiguiendo" name="bosiguiendo"/>
                                        <label style="font-weight:bold;" for="bosiguiendo">Siguiendo</label>
                                        <label for="bosiguiendo"> &nbsp; Se eliminar&aacute; la lista de todos a los que sigue.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bofavoritos" name="bofavoritos"/>
                                        <label style="font-weight:bold;" for="bofavoritos">Favoritos</label>
                                        <label for="bofavoritos"> &nbsp; Se eliminar&aacute; la lista de favoritos que haya agregado.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bovotosposts" name="bovotosposts"/>
                                        <label style="font-weight:bold;" for="bovotosposts">Votos en Posts</label>
                                        <label for="bovotosposts"> &nbsp; Se eliminar&aacute;n los votos de puntos que haya dejado en posts.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bovotosfotos" name="bovotosfotos"/>
                                        <label style="font-weight:bold;" for="bovotosfotos">Votos en Fotos</label>
                                        <label for="bovotosfotos"> &nbsp; Se eliminar&aacute;n los votos positivos y negativos que haya dejado en fotos.</label>
										<br /><hr/>
                                        <input type="checkbox" id="boactividad" name="boactividad"/>
                                        <label style="font-weight:bold;" for="boactividad">Actividad</label>
                                        <label for="boactividad"> &nbsp; Se eliminar&aacute; toda su actividad.</label>
										<br /><hr/>
                                        <input type="checkbox" id="boavisos" name="boavisos"/>
                                        <label style="font-weight:bold;" for="boavisos">Avisos</label>
                                        <label for="boavisos"> &nbsp; Se eliminar&aacute;n todos los avisos que ha recibido.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bobloqueos" name="bobloqueos"/>
                                        <label style="font-weight:bold;" for="bobloqueos">Bloqueos</label>
                                        <label for="bobloqueos"> &nbsp; Se eliminar&aacute;n todos los bloqueos que ha recibido.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bomensajes" name="bomensajes"/>
                                        <label style="font-weight:bold;" for="bomensajes">Mensajes Privados</label>
                                        <label for="bomensajes"> &nbsp; Se eliminar&aacute;n todos los mensajes que ha enviado y recibido.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bosesiones" name="bosesiones"/>
                                        <label style="font-weight:bold;" for="bosesiones">Sesiones</label>
                                        <label for="bosesiones"> &nbsp; Se eliminar&aacute;n todas las sesiones.</label>
										<br /><hr/>
                                        <input type="checkbox" id="bovisitas" name="bovisitas"/>
                                        <label style="font-weight:bold;" for="boavisos">Visitas</label>
                                        <label for="bovisitas"> &nbsp; 
                                            Se eliminar&aacute;n todo rastro de visitas de este usuario en perfiles, posts y fotos.</label>
					</div>
                                        <br /><hr/>
                                        Introduzca su contrase&ntilde;a para continuar: 
                                        <input type="password" name="password"/>
                                        <?
                                        }
					elseif ($tsType == 7)
                                        {    
                                        ?>    
									<legend>Modificar rango de usuario</legend>
										<dl>
											<dt><label>Rango actual:</label></dt>
											<dd>
                                                                                            <strong style="color:#<? echo $tsUserR['user']['r_color']; ?>"><? echo $tsUserR['user']['r_name']; ?></strong>
                                                                                        </dd>
										</dl>
										<dl>
											<dt><label for="user">Nuevo rango:</label></dt>
											<dd><select name="new_rango">
                                                                                        <?        
											foreach ($tsUserR['rangos'] as $r)
                                                                                        {
                                                                                        ?>
											<option value="<? echo $r['rango_id']; ?>" style="color:#<? echo $r['r_color']; ?>" <? if ($r['rango_id'] == $tsUserR['user']['rango_id']) echo 'selected="selected"'; ?>><? echo $r['r_name']; ?></option>
											<?
                                                                                        }
                                                                                        ?>
											</select></dd>
										</dl>
                                        <?
                                        }
					elseif ($tsType == 8)
                                        {
                                        ?>    
									<legend>Modificar firma de usuario</legend>
									<textarea name="firma" rows="3" cols="50"><? echo $tsUserF['user_firma']; ?></textarea>
                                        <?
                                        }
                                         else
                                        {
                                        ?>
									<div class="phpostAlfa">Pendiente</div>
					<?                                        
                                        }                                        
                                        ?>
									<p><input type="submit" name="save" value="Enviar Cambios" class="btn_g"/></p>
									</fieldset>
								</form>
                                            <?
                                    }
                                    ?>
								</div>