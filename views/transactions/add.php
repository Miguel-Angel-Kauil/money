<h2>ADD Transactions</h2>

<form action="<?php echo APP_URL."/transactions/add"; ?>" method="POST">
    <div class="form-group">
        <label for="operation">Operation:</label>
        <select class="form-control" name="operation" id="operation">
            <option value="egreso">Egreso</option>
            <option value="ingreso">Ingreso</option>
        </select>
    </div>
    
    <div class="form-group"> 
        <label for="account_id">Cuenta</label>
        <select class="form-control" name="account_id" id="account_id">
            <?php
            foreach ($accounts as $account):?>
            <option value="<?php echo $account["accounts"]["id"];?>">
                <?php echo $account ["accounts"] ["name"];?>
            </option>
            <?php endforeach;?>
        </select>
    </div>
    
    <div class="form-group"> 
        <label for="category_id">Categoria</label>
        <select class="form-control" name="category_id" id="category_id">
            <?php
            foreach ($categories as $category):?>
            <option value="<?php echo $category["categories"]["id"];?>">
                <?php echo $category ["categories"] ["name"];?>
            </option>
            <?php endforeach;?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="description">Descripción:</label>
        <textarea class="form-control" rows="3" type="text" name="description"></textarea>
    </div>
    
    <div class="form-group">
        <label for="date">Fecha:</label>
        <input class="form-control" type="date" name="date">
    </div>
    
    <div class="form-group">
        <label for="amount">Cantidad:</label>
        <input class="form-control" type="text" name="amount">
    </div>
    <button type="submit" class="btn btn-primary">ADD</button>
    

</form>
