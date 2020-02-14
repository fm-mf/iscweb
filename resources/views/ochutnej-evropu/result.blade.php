@extends('czech.layouts.layout')

@section('page')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-md-auto">
                    @if(!session()->has('success'))
                        <div class="alert alert-warning">
                            <p>
                                Nevyplnili jste soutěžní kvíz. Kvíz najdete <a class="alert-link" href="{{ route('ochutnej-evropu.index') }}">zde</a>.
                            </p>
                        </div>
                    @else
                        @if(session('success'))
                            <div class="alert alert-success">
                                <p>
                                    <span class="fas fa-pizza-slice fa-10x"></span>
                                </p>
                                <p>
                                    <strong>Gratulujeme!</strong> Odpověděli jste správně alespoň na třetí otázku. Vyhráváte tedy kousek pizzy.
                                </p>
                            </div>
                        @else
                            <div class="alert alert-danger">
                                <p>
                                    Je nám líto, ale odpověděli jste špatně na třetí otázku. Pizzu tedy nevyhráváte.
                                </p>
                            </div>
                        @endif

                        <h1>Kvíz Ochutnej Evropu – spávné odpovědi</h1>

                        <h3 class="required">Kolik studentů ČVUT vyjelo v minulém semestru (ZS 2019/20) na Erasmus+?</h3>
                        <div class="form-group">
                            <div class="btn-group btn-group-toggle d-flex flex-column col-10 mx-auto">
                                <label class="btn disabled @if($answers['answer1']['answered'] === 'a') active @if($answers['answer1']['correct']) btn-success @else btn-danger @endif @else @if($answers['answer1']['expected'] === 'a') btn-success @else btn-secondary @endif @endif">
                                    <input type="radio" name="answer1" id="answer1a" value="a" autocomplete="off" @if($answers['answer1']['answered'] === 'a') checked="checked" @endif /> 173
                                </label>
                                <label class="btn disabled @if($answers['answer1']['answered'] === 'b') active @if($answers['answer1']['correct']) btn-success @else btn-danger @endif @else  @if($answers['answer1']['expected'] === 'b') btn-success @else btn-secondary @endif @endif ml-0">
                                    <input type="radio" name="answer1" id="answer1b" value="b" autocomplete="off" @if($answers['answer1']['answered'] === 'b') checked="checked" @endif  /> 234
                                </label>
                                <label class="btn disabled @if($answers['answer1']['answered'] === 'c') active @if($answers['answer1']['correct']) btn-success @else btn-danger @endif @else  @if($answers['answer1']['expected'] === 'c') btn-success @else btn-secondary @endif @endif ml-0">
                                    <input type="radio" name="answer1" id="answer1c" value="c" autocomplete="off" @if($answers['answer1']['answered'] === 'c') checked="checked" @endif  /> 297
                                </label>
                                <label class="btn disabled @if($answers['answer1']['answered'] === 'd') active @if($answers['answer1']['correct']) btn-success @else btn-danger @endif @else  @if($answers['answer1']['expected'] === 'd') btn-success @else btn-secondary @endif @endif ml-0">
                                    <input type="radio" name="answer1" id="answer1d" value="d" autocomplete="off" @if($answers['answer1']['answered'] === 'd') checked="checked" @endif  /> 351
                                </label>
                            </div>
                        </div>

                        <h3 class="required">Na kolik různých univerzit lze vyjet v příštím akademickém roce (2020/21) přes program Erasmus+?</h3>
                        <div class="form-group">
                            <div class="btn-group btn-group-toggle d-flex flex-column col-10 mx-auto">
                                <label class="btn disabled @if($answers['answer2']['answered'] === 'a') active @if($answers['answer2']['correct']) btn-success @else btn-danger @endif @else @if($answers['answer2']['expected'] === 'a') btn-success @else btn-secondary @endif @endif">
                                    <input type="radio" name="answer2" id="answer2a" value="a" autocomplete="off" @if($answers['answer2']['answered'] === 'a') checked="checked" @endif  /> 193
                                </label>
                                <label class="btn disabled @if($answers['answer2']['answered'] === 'b') active @if($answers['answer2']['correct']) btn-success @else btn-danger @endif @else @if($answers['answer2']['expected'] === 'b') btn-success @else btn-secondary @endif @endif ml-0">
                                    <input type="radio" name="answer2" id="answer2b" value="b" autocomplete="off" @if($answers['answer2']['answered'] === 'b') checked="checked" @endif  /> 226
                                </label>
                                <label class="btn disabled @if($answers['answer2']['answered'] === 'c') active @if($answers['answer2']['correct']) btn-success @else btn-danger @endif @else @if($answers['answer2']['expected'] === 'c') btn-success @else btn-secondary @endif @endif ml-0">
                                    <input type="radio" name="answer2" id="answer2c" value="c" autocomplete="off" @if($answers['answer2']['answered'] === 'c') checked="checked" @endif  /> 251
                                </label>
                                <label class="btn disabled @if($answers['answer2']['answered'] === 'd') active @if($answers['answer2']['correct']) btn-success @else btn-danger @endif @else @if($answers['answer2']['expected'] === 'd') btn-success @else btn-secondary @endif @endif ml-0">
                                    <input type="radio" name="answer2" id="answer3d" value="d" autocomplete="off" @if($answers['answer2']['answered'] === 'd') checked="checked" @endif  /> 274
                                </label>
                            </div>
                        </div>

                        <h3 class="required">Do kdy musím podat přihlášku do druhého kola na Erasmus+? </h3>
                        <p class="alert alert-info">Pro výhru kousku pizzy <span class="fas fa-pizza-slice"></span> jen nutné na tuto otázku odpovědět správně.</p>
                        <div class="form-group">
                            <div class="btn-group btn-group-toggle d-flex flex-column col-10 mx-auto">
                                <label class="btn disabled @if($answers['answer3']['answered'] === 'a') active @if($answers['answer3']['correct']) btn-success @else btn-danger @endif @else @if($answers['answer3']['expected'] === 'a') btn-success @else btn-secondary @endif @endif">
                                    <input type="radio" name="answer3" id="answer3a" value="a" autocomplete="off" @if($answers['answer3']['answered'] === 'a') checked="checked" @endif /> 28. února 2020
                                </label>
                                <label class="btn disabled @if($answers['answer3']['answered'] === 'b') active @if($answers['answer3']['correct']) btn-success @else btn-danger @endif @else @if($answers['answer3']['expected'] === 'b') btn-success @else btn-secondary @endif @endif ml-0">
                                    <input type="radio" name="answer3" id="answer3b" value="b" autocomplete="off" @if($answers['answer3']['answered'] === 'b') checked="checked" @endif /> 6. března 2020
                                </label>
                                <label class="btn disabled @if($answers['answer3']['answered'] === 'c') active @if($answers['answer3']['correct']) btn-success @else btn-danger @endif @else @if($answers['answer3']['expected'] === 'c') btn-success @else btn-secondary @endif @endif ml-0">
                                    <input type="radio" name="answer3" id="answer3c" value="c" autocomplete="off" @if($answers['answer3']['answered'] === 'c') checked="checked" @endif /> 13. března 2020
                                </label>
                                <label class="btn disabled @if($answers['answer3']['answered'] === 'd') active @if($answers['answer3']['correct']) btn-success @else btn-danger @endif @else @if($answers['answer3']['expected'] === 'd') btn-success @else btn-secondary @endif @endif ml-0">
                                    <input type="radio" name="answer3" id="answer3d" value="d" autocomplete="off" @if($answers['answer3']['answered'] === 'd') checked="checked" @endif /> 20. března 2020
                                </label>
                            </div>
                        </div>

                        <h3 class="required">Jaké stipendium dostanou studenti při výjezdu do Finska – 1. stipendijní skupina zemí?</h3>
                        <div class="form-group">
                            <div class="btn-group btn-group-toggle d-flex flex-column col-10 mx-auto">
                                <label class="btn disabled @if($answers['answer4']['answered'] === 'a') active @if($answers['answer4']['correct']) btn-success @else btn-danger @endif @else @if($answers['answer4']['expected'] === 'a') btn-success @else btn-secondary @endif @endif">
                                    <input type="radio" name="answer4" id="answer4a" value="a" autocomplete="off" @if($answers['answer4']['answered'] === 'a') checked="checked" @endif /> 360 EUR
                                </label>
                                <label class="btn disabled @if($answers['answer4']['answered'] === 'b') active @if($answers['answer4']['correct']) btn-success @else btn-danger @endif @else @if($answers['answer4']['expected'] === 'b') btn-success @else btn-secondary @endif @endif ml-0">
                                    <input type="radio" name="answer4" id="answer4b" value="b" autocomplete="off" @if($answers['answer4']['answered'] === 'b') checked="checked" @endif /> 410 EUR
                                </label>
                                <label class="btn disabled @if($answers['answer4']['answered'] === 'c') active @if($answers['answer4']['correct']) btn-success @else btn-danger @endif @else @if($answers['answer4']['expected'] === 'c') btn-success @else btn-secondary @endif @endif ml-0">
                                    <input type="radio" name="answer4" id="answer4c" value="c" autocomplete="off" @if($answers['answer4']['answered'] === 'c') checked="checked" @endif /> 460 EUR
                                </label>
                                <label class="btn disabled @if($answers['answer4']['answered'] === 'd') active @if($answers['answer4']['correct']) btn-success @else btn-danger @endif @else @if($answers['answer4']['expected'] === 'd') btn-success @else btn-secondary @endif @endif ml-0">
                                    <input type="radio" name="answer4" id="answer4d" value="d" autocomplete="off" @if($answers['answer4']['answered'] === 'd') checked="checked" @endif /> 510 EUR
                                </label>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
