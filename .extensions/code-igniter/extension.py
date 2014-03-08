"""Code Igniter Extension

Downloads, installs and configures Code Igniter
"""
import os
import logging
from build_pack_utils import utils


_log = logging.getLogger('codeigniter')


DEFAULTS = utils.FormattedDict({
    'CODEIGNITER_VERSION': '2.1.4',
    'CODEIGNITER_PACKAGE': 'CodeIgniter_{CODEIGNITER_VERSION}.zip',
    'CODEIGNITER_HASH': '28abc67cfec406c74cb8c64499f1fafb92c6840e',
    'CODEIGNITER_URL': 'http://ellislab.com/asset/ci_download_files'
                       '/CodeIgniter_{CODEIGNITER_VERSION}.zip'
})


# Extension Methods
def preprocess_commands(ctx):
    return ()


def service_commands(ctx):
    return {}


def service_environment(ctx):
    return {}


def compile(install):
    print 'Installing Code Igniter %s' % DEFAULTS['CODEIGNITER_VERSION']
    ctx = install.builder._ctx
    inst = install._installer
    ciDir = 'codeigniter'
    workDir = os.path.join(ctx['TMPDIR'], ciDir)
    inst.install_binary_direct(
        DEFAULTS['CODEIGNITER_URL'],
        DEFAULTS['CODEIGNITER_HASH'],
        workDir,
        fileName=DEFAULTS['CODEIGNITER_PACKAGE'])
    (install.builder
        .move()
        .everything()
        .where_name_matches('^%s.*$' % os.path.join(workDir, 'system'))
        .under(workDir)
        .into('{BUILD_DIR}/%s' % ciDir)
        .done())
    (install.builder
        .move()
        .everything()
        .where_name_matches('^%s.*$' % os.path.join(workDir, 'application'))
        .under(workDir)
        .into('{BUILD_DIR}/%s' % ciDir)
        .done())
    userAppFolder = os.path.join(ctx['BUILD_DIR'], 'htdocs', 'application')
    (install.builder
        .move()
        .everything()
        .under('{BUILD_DIR}/htdocs')
        .where_name_matches('^%s.*$' % userAppFolder)
        .into('{BUILD_DIR}/%s' % ciDir)
        .done())
    return 0
