<div>
    <section class="section-flex">
        <article class="section-content-page diametro">
            <h3>Nuevo Ticket</h3>

            <div class="user-form">
                <section>
                    <article>
                        <div class="body-details-ticket">
                            <form>
                                <div>
                                    <section>
                                        <article>
                                            <section class="display-inline">
                                                <article>
                                                    <div class="details-ticket-subtitle">
                                                        <span>Fecha de inicio</span>
                                                    </div>
                                                </article>
                                                <article>
                                                    <input type="date" name="fechaini" class="edit-ticket-field">
                                                </article>
                                            </section>
                                        </article>

                                        <article class="align-right">
                                            <section class="display-inline">
                                                <article>
                                                    <div class="details-ticket-subtitle">
                                                        <span>Fecha vence</span>
                                                    </div>
                                                </article>
                                                <article>
                                                    <input type="date" name="fechavence" class="edit-ticket-field">
                                                </article>
                                            </section>
                                        </article>
                                    </section>
                                </div>

                                <div>
                                    <section>
                                        <article>
                                            <section class="display-inline">
                                                <article>
                                                    <div class="details-ticket-subtitle">
                                                        <span>Nombre</span>
                                                    </div>
                                                </article>
                                                <article>
                                                    <input type="text" name="nombre" class="edit-ticket-field">
                                                </article>
                                            </section>
                                        </article>

                                        <article class="align-right">
                                            <section class="display-inline">
                                                <article>
                                                    <div class="details-ticket-subtitle">
                                                        <span>Sucursal</span>
                                                    </div>
                                                </article>
                                                <article>
                                                    <input type="text" name="sucursal" class="edit-ticket-field">
                                                </article>
                                            </section>
                                        </article>
                                    </section>
                                </div>

                                <div>
                                    <section>
                                        <article>
                                            <section class="display-inline">
                                                <article>
                                                    <div class="details-ticket-subtitle">
                                                        <span>Documento</span>
                                                    </div>
                                                </article>
                                                <article>
                                                    <input type="number" name="documento" class="edit-ticket-field">
                                                </article>
                                            </section>
                                        </article>

                                        <article class="align-right">
                                            <section>
                                                <article>
                                                    <section class="display-inline time-ticket">
                                                        <article>
                                                            <div class="details-ticket-subtitle">
                                                                <span>Teléfono</span>
                                                            </div>
                                                        </article>
                                                        <article>
                                                            <input type="number" name="telefono" class="edit-ticket-field-additional">
                                                        </article>
                                                    </section>
                                                </article>
                                                <article>
                                                    <section class="display-inline time-ticket">
                                                        <article>
                                                            <div class="details-ticket-subtitle">
                                                                <span>Limite</span>
                                                            </div>
                                                        </article>
                                                        <article>
                                                            <input type="text" name="limite" class="edit-ticket-field-additional">
                                                        </article>
                                                    </section>
                                                </article>
                                            </section>
                                        </article>
                                    </section>
                                </div>

                                <div>
                                    <section>
                                        <article>
                                            <section class="display-inline">
                                                <article>
                                                    <div class="details-ticket-subtitle">
                                                        <span>Correo</span>
                                                    </div>
                                                </article>
                                                <article>
                                                    <input type="email" name="email" class="edit-ticket-field">
                                                </article>
                                            </section>
                                        </article>

                                        <article class="align-right">
                                            <section>
                                                <article>
                                                    <section class="display-inline">
                                                        <article>
                                                            <div class="details-ticket-subtitle">
                                                                <span>Direcci&oacute;n</span>
                                                            </div>
                                                        </article>
                                                        <article>
                                                            <input type="text" name="direccion" class="edit-ticket-field">
                                                        </article>
                                                    </section>
                                                </article>
                                            </section>
                                        </article>
                                    </section>
                                </div>

                                <div class="ddlselection">
                                    <section>
                                        <article>
                                            <section class="display-inline">
                                                <article>
                                                    <div class="details-ticket-subtitle">
                                                        <span>Urgencia</span>
                                                    </div>
                                                </article>
                                                <article>
                                                    <select id="ddlurgencia" class="select-style">
                                                        <option value="seleccione">-- Seleccione --</option>
                                                        <option value="alta">Alta</option>
                                                        <option value="media">Media</option>
                                                        <option value="baja">Baja</option>
                                                    </select>
                                                </article>
                                            </section>
                                        </article>

                                        <article class="align-right">
                                            <section class="display-inline">
                                                <article>
                                                    <div class="details-ticket-subtitle">
                                                        <span>Tipo</span>
                                                    </div>
                                                </article>
                                                <article>
                                                    <select id="ddltipo" class="select-style">
                                                        <option value="seleccione">-- Seleccione --</option>
                                                        <option value="incidencia">Incidencia</option>
                                                        <option value="requerimiento">Requerimiento</option>
                                                    </select>
                                                </article>
                                            </section>
                                        </article>
                                    </section>
                                </div>

                                <textarea rows="5" name="comentarios" class="textarea-margin"></textarea>

                                <input class="input-file" type="file" name="file">

                                <div class="center-button">
                                    <button class="btn-gris" type="submit" onclick="cancelar(); return false;">Cancelar</button>
                                    <button class="btn-gris" type="submit">Crear Ticket</button>
                                </div>
                            </form>
                        </div>
                    </article>
                </section>
            </div>
        </article>
    </section>
</div>

<script type="text/javascript">
    function cancelar() {
        $.ajax({
            method: "post",
            url: "bandejaticket.php",
            data: {},
            success: function(data) {
                $("#content").html(data)
            }
        });
    }
</script>