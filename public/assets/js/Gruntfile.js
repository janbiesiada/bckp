module.exports = function(grunt) {

    // 1. All configuration goes here 
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        concat: {   
            dist: {
                src: [
                    '../bower_components/jquery/dist/jquery.min.js',
                    '../bower_components/bootstrap/dist/js/bootstrap.min.js',
                    'libs/*.js', 
                    'global/*.js'
                ],
                dest: 'build/app.js',
            }
            /*,
            dist: {
                src: [
                    '../../admin/assets/js/global/*.js'
                ],
                dest: '../../admin/assets/js/app.js',
            }*/
        },
        
        
        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    '../css/stylesheets/style.css' : '../css/sass/app.scss'
                }
            } 
        },
        
        uglify: {
            build: {
                src:  'build/app.js',
                dest: 'build/app.min.js'
            },
            /*build: {
                src:  '../../admin/assets/js/app.js',
                dest: '../../admin/assets/js/app.min.js'
            }*/
        },
    
        
        watch: {
            scripts: {
                files: ['global/*.js','../../admin/assets/js/global/*.js'],
                tasks: ['concat', 'uglify']
            },
            css: {
                files: [
                    '../css/imports/*.scss',
                    '../css/imports/forms/*.scss',
                    '../css/sass/app.scss'
                
                ],
                tasks: ['sass'],
                options: {
                    spawn: false,
                }
            }
        } 

    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-contrib-concat');
    
    grunt.loadNpmTasks('grunt-contrib-uglify');
    
    grunt.loadNpmTasks('grunt-contrib-watch');
    
    grunt.loadNpmTasks('grunt-contrib-sass');
    
    grunt.registerTask('default', 'watch');


};