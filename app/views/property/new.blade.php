@extends('layout')

@section('content')
    <div class="large-9 columns">
          <div class="row">
              <div class="large-12 columns">
                  <h2><i class="fa fa-newspaper-o"></i> Nueva Publicación</h2>
              </div>
          </div>
        <form>
        <div class="row">
    <div class="large-12 columns">
      <label>Tipo de Publicación
        <select>
          <option value="husker">Free</option>
          <option value="starbuck">Premium</option>
          <option value="hotdog">...</option>
        </select>
      </label>
    </div>

  </div>
  <div class="row">
    <div class="large-12 columns">
      <label>Tipo de Operación
        <select>
          <option value="husker">Venta</option>
          <option value="starbuck">Alquiler</option>
          <option value="hotdog">Alquiler Temporal</option>
        </select>
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <label>Tipo de Propiedad
        <select>
          <option value="husker">Departamento</option>
          <option value="starbuck">Casa</option>
          <option value="hotdog">Oficina</option>
        </select>
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
    <h5>Propiedad</h5>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <label>Nombre
        <input type="text" placeholder="" />
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <label>Descripción
        <textarea placeholder=""></textarea>
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
      <label>Barrio
        <select>
          <option value="husker">Almagro</option>
          <option value="starbuck">Palermo</option>
          <option value="hotdog">Balvanera</option>
        </select>
      </label>
    </div>
    <div class="large-8 columns">
      <label>Direccion
        <input type="text" placeholder="" />
      </label>
    </div>
  </div>
  <div class="row">
    <div class="large-4 columns">
      <div class="row collapse">
        <label>Tamaño</label>
        <div class="small-9 columns">
          <input type="text" placeholder="" />
        </div>
        <div class="small-3 columns">
          <span class="postfix">m<sup>2</sup></span>
        </div>
      </div>
    </div>
    <div class="large-4 columns">
      <div class="row collapse">
        <label>Ambientes</label>
        <div class="small-12 columns">
          <select name="" id="">
            <option value="">1</option>
            <option value="">2</option>
            <option value="">3</option>
            <option value="">4</option>
          </select>
        </div>
      </div>
    </div>
    <div class="large-4 columns">
      <div class="row collapse">
        <label>Antiguedad</label>
        <div class="small-9 columns">
          <input type="text" placeholder="" />
        </div>
        <div class="small-3 columns">
          <span class="postfix">años</span>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
  <div class="large-4 columns">
      <div class="row collapse">
        <label>Moneda</label>
        <div class="small-12 columns">
          <select name="" id="">
            <option value="">$</option>
            <option value="">U$S</option>
          </select>
        </div>
      </div>
    </div>
    <div class="large-4 columns">
      <div class="row collapse">
        <label>Precio</label>
        <div class="small-12 columns">
          <input type="text" placeholder="" />
        </div>
      </div>
    </div>
    <div class="large-4 columns">
      <div class="row collapse">
        <label>Expensas</label>
        <div class="small-12 columns">
          <input type="text" placeholder="" />
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <input type="submit" value="Guardar" class="button"/>
      <a href="" class="button secondary">Cancelar</a>
    </div>
  </div>
</form>
        </div>
@stop