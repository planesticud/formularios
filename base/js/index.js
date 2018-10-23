$(document).ready(function() {
    $('#contact_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                        stringLength: {
                        min: 2,
                        message: 'No valido'
                    },
                        notEmpty: {
                        message: 'Por favor ponga su nombre'
                    }
                }
            },
             last_name: {
                validators: {
                     stringLength: {
                        min: 2,
                         message: 'No valido'
                    },
                    notEmpty: {
                        message: 'Por favor ponga su apellido'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Por favor ponga su email'
                    },
                    emailAddress: {
                        message: 'Por favor ponga un email valido'
                    }
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: 'Por favor ponga su teléfono'
                    }
                }
            },
            documento: {
                validators: {
                     stringLength: {
                        min: 5,
                    },
                    notEmpty: {
                        message: 'Por favor ponga su documento'
                    }
                }
            },
            tdoc: {
                validators: {
               
                    notEmpty: {
                        message: 'Por favor seleccione una opción'
                    }
                }
            },
             vinculacion: {
                validators: {
               
                    notEmpty: {
                        message: 'Por favor seleccione una opción'
                    }
                }
            },
             p2: {
                validators: {
               
                    notEmpty: {
                        message: 'Por favor seleccione una opción'
                    }
                }
            },
            fac_dep: {
                validators: {
                    notEmpty: {
                        message: 'Por favor ponga la facultad o dependencia'
                    }
                }
            },
            pcurricular: {
                validators: {
                    notEmpty: {
                        message: 'Por favor indique su proyecto curricular'
                    }
                    
                }
            },
            codigo: {
                validators: {
                    notEmpty: {
                        message: 'Por favor ponga su código, número de contrato- si no aplica ponga un 0'
                    }
                }
            },
             cursos: {
                validators: {
                    notEmpty: {
                        message: 'Por favor seleccione una opción'
                    }
                }
            },
            comment: {
                validators: {
                      stringLength: {
                        min: 10,
                        max: 200,
                        message:'su escrito debe tener entre 10 caracteres y 200 caracteres'
                    },
                    notEmpty: {
                        message: 'Describa sus intereses'
                    }
                    }
                }
            }
        })
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#contact_form').data('bootstrapValidator').resetForm();

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
            }, 'json');
        });
});