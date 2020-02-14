@extends('czech.layouts.layout')

@section('page')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-md-auto">
                    <h1>Kvíz Ochutnej Evropu</h1>
                    <form action="{{ route('ochutnej-evropu.evaluate') }}" method="POST">
                        {{ csrf_field() }}

                        <h3 class="required">Kolik studentů ČVUT vyjelo v minulém semestru (ZS 2019/20) na Erasmus+?</h3>
                        <div class="form-group">
                            <div class="btn-group btn-group-toggle d-flex flex-column col-10 mx-auto" data-toggle="buttons">
                                <label class="btn btn-secondary">
                                    <input type="radio" name="answer1" id="answer1a" value="a" autocomplete="off" /> 173
                                </label>
                                <label class="btn btn-secondary ml-0">
                                    <input type="radio" name="answer1" id="answer1b" value="b" autocomplete="off" /> 234
                                </label>
                                <label class="btn btn-secondary ml-0">
                                    <input type="radio" name="answer1" id="answer1c" value="c" autocomplete="off" /> 297
                                </label>
                                <label class="btn btn-secondary ml-0">
                                    <input type="radio" name="answer1" id="answer1d" value="d" autocomplete="off" /> 351
                                </label>
                            </div>
                        </div>

                        <h3 class="required">Na kolik různých univerzit lze vyjet v příštím akademickém roce (2020/21) přes program Erasmus+?</h3>
                        <div class="form-group">
                            <div class="btn-group btn-group-toggle d-flex flex-column col-10 mx-auto" data-toggle="buttons">
                                <label class="btn btn-secondary">
                                    <input type="radio" name="answer2" id="answer2a" value="a" autocomplete="off" /> 193
                                </label>
                                <label class="btn btn-secondary ml-0">
                                    <input type="radio" name="answer2" id="answer2b" value="b" autocomplete="off" /> 226
                                </label>
                                <label class="btn btn-secondary ml-0">
                                    <input type="radio" name="answer2" id="answer2c" value="c" autocomplete="off" /> 251
                                </label>
                                <label class="btn btn-secondary ml-0">
                                    <input type="radio" name="answer2" id="answer3d" value="d" autocomplete="off" /> 274
                                </label>
                            </div>
                        </div>

                        <h3 class="required">Do kdy musím podat přihlášku do druhého kola na Erasmus+? </h3>
                        <p class="alert alert-info">Pro výhru kousku pizzy <span class="fas fa-pizza-slice"></span> jen nutné na tuto otázku odpovědět správně.</p>
                        <div class="form-group">
                            <div class="btn-group btn-group-toggle d-flex flex-column col-10 mx-auto" data-toggle="buttons">
                                <label class="btn btn-secondary">
                                    <input type="radio" name="answer3" id="answer3a" value="a" autocomplete="off" /> 28. února 2020
                                </label>
                                <label class="btn btn-secondary ml-0">
                                    <input type="radio" name="answer3" id="answer3b" value="b" autocomplete="off" /> 6. března 2020
                                </label>
                                <label class="btn btn-secondary ml-0">
                                    <input type="radio" name="answer3" id="answer3c" value="c" autocomplete="off" /> 13. března 2020
                                </label>
                                <label class="btn btn-secondary ml-0">
                                    <input type="radio" name="answer3" id="answer3d" value="d" autocomplete="off" /> 20. března 2020
                                </label>
                            </div>
                        </div>

                        <h3 class="required">Jaké stipendium dostanou studenti při výjezdu do Finska – 1. stipendijní skupina zemí?</h3>
                        <div class="form-group">
                            <div class="btn-group btn-group-toggle d-flex flex-column col-10 mx-auto" data-toggle="buttons">
                                <label class="btn btn-secondary">
                                    <input type="radio" name="answer4" id="answer4a" value="a" autocomplete="off" /> 360 EUR
                                </label>
                                <label class="btn btn-secondary ml-0">
                                    <input type="radio" name="answer4" id="answer4b" value="b" autocomplete="off" /> 410 EUR
                                </label>
                                <label class="btn btn-secondary ml-0">
                                    <input type="radio" name="answer4" id="answer4c" value="c" autocomplete="off" /> 460 EUR
                                </label>
                                <label class="btn btn-secondary ml-0">
                                    <input type="radio" name="answer4" id="answer4d" value="d" autocomplete="off" /> 510 EUR
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Odeslat</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
