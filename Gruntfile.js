module.exports = function (grunt) {

    // Configuration goes here
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        // Metadata
        meta: {
            modulePath: 'mod_bix_prijsvergelijk',
            languagePath: 'language',
            buildPath: 'build',
            tempPath: 'tmp',
            langs: ['nl-NL']
        },
        copy: {
            module: {
                files: [
                    {
                        expand: true,
                        cwd: '<%= meta.modulePath %>',
                        src: ['**'],
                        dest: '<%= meta.tempPath %>'
                    },
                    {
                        expand: true,
                        cwd: '<%= meta.languagePath %>',
                        src: ['**'],
                        dest: '<%= meta.tempPath %>/language'
                    }
                ]
            }
        },
        compress: {
            module: {
                options: {
                    archive: '<%= meta.buildPath %>/<%= pkg.name %>_<%= pkg.version %>.zip',
                    mode: 'zip'
                },
                files: [
                    {
                        expand: true,
                        cwd: '<%= meta.tempPath %>',
                        src: ['**'],
                        dest: ''
                    }
                ]
            }
        },
        // remove temporal files
        clean: {
            temp: ['<%= meta.tempPath %>/**/*']
        }
    });

    // Load plugins here
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-clean');

    // Define your tasks here
    // register default task
    grunt.registerTask('default', 'Prepares Module Package', function () {

        // execute in order
        grunt.task.run('copy:module');
        grunt.task.run('compress');
        grunt.task.run('clean:temp');
    });

};