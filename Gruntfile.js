module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
            },
            build: {
                src: 'app/Resources/public/js/*.js',
                dest: 'web/bundles/build/<%= pkg.name %>.min.js'
            }
        },
        cssmin: {
            target: {
                files: [{
                    expand: true,
                    cwd: 'app/Resources/public',
                    src: ['css/*.css', 'css/!*.min.css'],
                    dest: 'web/bundles/build',
                    ext: '.min.css'
                }]
            }
        },
        bower_concat: {
            all: {
                dest: 'build/_bower.js',
                cssDest: 'build/_bower.css',
                exclude: [
                    'jquery',
                    'modernizr'
                ],
                    dependencies: {
                    'underscore': 'jquery',
                        'backbone': 'underscore',
                        'jquery-mousewheel': 'jquery'
                },
                bowerOptions: {
                    relative: false
                }
            }
        },
        copy: {
            main: {
                files: [
                    // includes files within path
                    {expand: true, src: ['app/Resources/public/img/**'], dest: 'web/bundles/build/img'}
                ]
            }
        }
    });


    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-bower-concat');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-copy');

    // Default task(s).
    grunt.registerTask('default', ['uglify', 'bower_concat', 'cssmin', 'copy']);

};