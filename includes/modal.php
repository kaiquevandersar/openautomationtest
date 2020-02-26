<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!– Cabeçalho da janela modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Informe Login e Senha</h4>
            </div>
            <!– Corpo da janela modal -->
            <form action="login.php" method="post" id="formLogin" name="formLogin">
                <div class="form-group">
                    <label for="login">Login:</label>
                    <input type="number" class="form-control" id="login" name="login" required placeholder="CPF - Somente números">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" name="pwd" required>
                </div>
                <!– Rodapé da janela modal -->
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default limpar">Limpar</button>
                    <button type="submit" class="btn btn-primary enviar" formtarget="_blank">Acessar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>

