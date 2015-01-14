"""Code Igniter Extension

Downloads, installs and configures Code Igniter
"""
import os
import logging
from build_pack_utils import utils


_log = logging.getLogger('codeigniter')


DEFAULTS = utils.FormattedDict({
    'CODEIGNITER_VERSION': '2.2',
    'CODEIGNITER_PACKAGE': '{CODEIGNITER_VERSION}-stable.zip',
    'CODEIGNITER_HASH': 'd51c969431505ec75d70a5d79a22516ccc46202a',
    'CODEIGNITER_URL': 'https://github.com/bcit-ci/CodeIgniter/archive/2.2-stable.zip'
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
    if not os.path.exists(workDir):
        os.makedirs(workDir)
    inst.install_binary_direct(
        DEFAULTS['CODEIGNITER_URL'],
        DEFAULTS['CODEIGNITER_HASH'],
        workDir,
        fileName=DEFAULTS['CODEIGNITER_PACKAGE'],
        strip=True)
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
